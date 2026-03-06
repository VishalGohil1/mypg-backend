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
        
        // 2. Available Beds (static for now)
        $totalBeds =  PgGroup::whereId($pgGroupId)->first()->available_beds;
        // dd($totalBeds);
        $availableBeds = $totalBeds - $totalMembers;

        // 3. Monthly Revenue (current month paid)
        $monthlyRevenue = RentPayment::where('pg_group_id', $pgGroupId)
            ->where('status', 'paid')
            ->whereMonth('payment_date', now()->month)
            ->whereYear('payment_date', now()->year)
            ->sum('amount');

        // 4. Pending payments this month
        $pendingCount = Member::where('pg_group_id', $pgGroupId)
            ->where('is_active', 1)
            ->whereNotIn('id', function ($query) use ($pgGroupId) {
                $query->select('member_id')
                    ->from('rent_payments')
                    ->where('pg_group_id', $pgGroupId)
                    ->where('status', 'paid')
                    ->whereMonth('payment_date', now()->month)
                    ->whereYear('payment_date', now()->year);
            })->count();

        // 5. Total collected this year
        $yearlyRevenue = RentPayment::where('pg_group_id', $pgGroupId)
            ->where('status', 'paid')
            ->whereYear('payment_date', now()->year)
            ->sum('amount');

        // 6. New members this month
        $newMembersThisMonth = Member::where('pg_group_id', $pgGroupId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // 7. Last 6 months revenue trend
        $trend = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $trend[] = [
                'month' => $date->format('M'),
                'amount' => RentPayment::where('pg_group_id', $pgGroupId)
                    ->where('status', 'paid')
                    ->whereMonth('payment_date', $date->month)
                    ->whereYear('payment_date', $date->year)
                    ->sum('amount'),
            ];
        }

        return response()->json([
            'total_members'        => $totalMembers,
            'available_beds'       => $availableBeds,
            'monthly_revenue'      => $monthlyRevenue,
            'pending_count'        => $pendingCount,
            'yearly_revenue'       => $yearlyRevenue,
            'new_members_month'    => $newMembersThisMonth,
            'revenue_trend'        => $trend,
        ]);
    }
}
