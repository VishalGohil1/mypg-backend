<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\PgGroup;
use App\Models\PGGroupUser;
use App\Models\RentPayment;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $groupUser = PGGroupUser::where('user_id', $user->id)->first();
        if (!$groupUser) {
            return response()->json(['message' => 'User not linked to any PG group'], 403);
        }

        $pgGroupId = $groupUser->pg_group_id;

        // 1. Total Active Members
        $totalMembers = Member::where('pg_group_id', $pgGroupId)
            ->where('is_active', 1)->count();

        // 2. Available Beds
        $totalBeds     = PgGroup::whereId($pgGroupId)->first()->available_beds;
        $availableBeds = $totalBeds - $totalMembers;

        // 3. Monthly Revenue (paid + partial both count)
        $monthlyRevenue = RentPayment::where('pg_group_id', $pgGroupId)
            ->whereIn('status', ['paid', 'partial'])
            ->whereMonth('payment_date', now()->month)
            ->whereYear('payment_date', now()->year)
            ->sum('amount');

        // 4. Pending count — no payment record at all this month
        $pendingCount = Member::where('pg_group_id', $pgGroupId)
            ->where('is_active', 1)
            ->whereNotIn('id', function ($query) use ($pgGroupId) {
                $query->select('member_id')
                    ->from('rent_payments')
                    ->where('pg_group_id', $pgGroupId)
                    ->whereIn('status', ['paid', 'partial'])   // ← exclude both
                    ->whereMonth('payment_date', now()->month)
                    ->whereYear('payment_date', now()->year);
            })->count();
        $fullPaidCount = RentPayment::where('pg_group_id', $pgGroupId)
            ->where('status', 'paid')                          // only fully paid
            ->whereMonth('payment_date', now()->month)
            ->whereYear('payment_date', now()->year)
            ->count();

        // 5. Part payment count — partial only this month
        $partialCount = RentPayment::where('pg_group_id', $pgGroupId)
            ->where('status', 'partial')
            ->whereMonth('payment_date', now()->month)
            ->whereYear('payment_date', now()->year)
            ->count();

        // 6. Yearly Revenue (paid + partial)
        $yearlyRevenue = RentPayment::where('pg_group_id', $pgGroupId)
            ->whereIn('status', ['paid', 'partial'])
            ->whereYear('payment_date', now()->year)
            ->sum('amount');

        // 7. New members this month
        $newMembersThisMonth = Member::where('pg_group_id', $pgGroupId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // 8. Last 6 months revenue trend (paid + partial)
        $trend = [];
        for ($i = 5; $i >= 0; $i--) {
            $date    = now()->subMonths($i);
            $trend[] = [
                'month'  => $date->format('M'),
                'amount' => RentPayment::where('pg_group_id', $pgGroupId)
                    ->whereIn('status', ['paid', 'partial'])
                    ->whereMonth('payment_date', $date->month)
                    ->whereYear('payment_date', $date->year)
                    ->sum('amount'),
            ];
        }

        // 9. Per collector summary this month
        $collectorSummary = RentPayment::with('collectedBy:id,first_name,last_name')
            ->where('pg_group_id', $pgGroupId)
            ->whereIn('status', ['paid', 'partial'])
            ->whereMonth('payment_date', now()->month)
            ->whereYear('payment_date', now()->year)
            ->get()
            ->groupBy('collected_by')
            ->map(function ($payments) {
                $collector = $payments->first()->collectedBy;
                return [
                    'name'          => $collector
                        ? trim($collector->first_name . ' ' . $collector->last_name)
                        : 'Unknown',
                    'total_amount'  => $payments->sum('amount'),
                    'total_members' => $payments->count(),
                ];
            })
            ->values();

        // Cash collected this month (cash + both modes + null/missing = cash by default)
        $cashTotal = RentPayment::where('pg_group_id', $pgGroupId)
            ->whereIn('status', ['paid', 'partial'])
            ->whereMonth('payment_date', now()->month)
            ->whereYear('payment_date', now()->year)
            ->where(function ($q) {
                $q->where('payment_mode', 'cash')
                    ->orWhere('payment_mode', 'both')
                    ->orWhereNull('payment_mode');   // ← missing entries default to cash
            })
            ->get()
            ->sum(function ($payment) {
                // For 'both' mode, only count the cash_amount portion
                if ($payment->payment_mode === 'both') {
                    return $payment->cash_amount ?? 0;
                }
                return $payment->amount;
            });

        // UPI collected this month
        $upiTotal = RentPayment::where('pg_group_id', $pgGroupId)
            ->whereIn('status', ['paid', 'partial'])
            ->whereMonth('payment_date', now()->month)
            ->whereYear('payment_date', now()->year)
            ->where(function ($q) {
                $q->where('payment_mode', 'upi')
                    ->orWhere('payment_mode', 'both');
            })
            ->get()
            ->sum(function ($payment) {
                // For 'both' mode, only count the upi_amount portion
                if ($payment->payment_mode === 'both') {
                    return $payment->upi_amount ?? 0;
                }
                return $payment->amount;
            });


        return response()->json([
            'total_members'     => $totalMembers,
            'available_beds'    => $availableBeds,
            'total_beds'        => $totalBeds,
            'monthly_revenue'   => $monthlyRevenue,
            'pending_count'     => $pendingCount,
            'partial_count'     => $partialCount,
            'yearly_revenue'    => $yearlyRevenue,
            'new_members_month' => $newMembersThisMonth,
            'revenue_trend'     => $trend,
            'collector_summary' => $collectorSummary,
            'full_paid_count' => $fullPaidCount,
            'cash_total' => $cashTotal,
            'upi_total'  => $upiTotal,

        ]);
    }
}
