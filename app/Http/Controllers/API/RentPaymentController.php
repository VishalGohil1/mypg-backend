<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\RentPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentPaymentController extends Controller
{
    /**
     * Get payment status for all members of a pg_group for a given month/year
     */
    public function getMonthlyStatus(Request $request)
    {
        $request->validate([
            'billing_year'  => 'required|integer',
            'billing_month' => 'required|integer|min:1|max:12',
        ]);

        $user      = Auth::user();
        $pgGroupId = $user->pg_group_id;
        $year      = $request->billing_year;
        $month     = $request->billing_month;

        $payments = RentPayment::with('collectedBy:id,first_name,last_name')
            ->where('pg_group_id', $pgGroupId)
            ->where('billing_year', $year)
            ->where('billing_month', $month)
            ->get()
            ->keyBy('member_id');

        // Cast keys to string so JSON gives {"2": ..., "3": ...} not {2: ..., 3: ...}
        $paymentsStringKeyed = $payments->mapWithKeys(fn($v, $k) => [(string)$k => $v]);

        return response()->json([
            'status' => true,
            'data'   => $paymentsStringKeyed,
        ]);
    }


    /**
     * Mark a member's rent as collected for the current month
     */
    public function collect(Request $request)
    {
        $request->validate([
            'member_id'     => 'required|exists:members,id',
            'billing_year'  => 'required|integer',
            'billing_month' => 'required|integer|min:1|max:12',
            'payment_mode'  => 'required|in:upi,cash,both',
            'payment_type'  => 'required|in:full,partial',
            'part_amount'   => 'required_if:payment_type,partial|nullable|numeric|min:1',
            'upi_amount'    => 'required_if:payment_mode,both|nullable|numeric|min:0',
            'cash_amount'   => 'required_if:payment_mode,both|nullable|numeric|min:0',
        ]);

        $user      = Auth::user();
        $pgGroupId = $user->pg_group_id;
        $member    = Member::where('id', $request->member_id)
            ->where('pg_group_id', $pgGroupId)
            ->firstOrFail();

        $isPartial   = $request->payment_type === 'partial';
        $amount      = $isPartial ? (float) $request->part_amount : (float) $member->rent_amount;
        $status      = $isPartial ? 'partial' : 'paid';
        $paymentMode = $request->payment_mode;
        $upiAmount   = $paymentMode === 'both' ? (float) $request->upi_amount  : null;
        $cashAmount  = $paymentMode === 'both' ? (float) $request->cash_amount : null;

        $existing = RentPayment::where('member_id', $request->member_id)
            ->where('billing_year', $request->billing_year)
            ->where('billing_month', $request->billing_month)
            ->first();

        if ($existing) {
            // Allow updating a partial payment, but lock a fully paid one
            if ($existing->status === 'paid') {
                return response()->json([
                    'status'  => false,
                    'message' => 'Payment already fully collected for this month.',
                ], 409);
            }

            // Update partial → full or partial → partial
            $existing->update([
                'amount'       => $amount,
                'payment_date' => now()->toDateString(),
                'collected_by' => $user->id,
                'status'       => $status,
                'payment_mode' => $paymentMode,
                'upi_amount'   => $upiAmount,
                'cash_amount'  => $cashAmount,
            ]);

            $payment = $existing->fresh();
        } else {
            $monthName = date('F', mktime(0, 0, 0, $request->billing_month, 1));

            $payment = RentPayment::create([
                'member_id'     => $member->id,
                'pg_group_id'   => $pgGroupId,
                'billing_year'  => $request->billing_year,
                'billing_month' => $request->billing_month,
                'amount'        => $amount,
                'payment_date'  => now()->toDateString(),
                'payment_month' => $monthName . ' ' . $request->billing_year,
                'collected_by'  => $user->id,
                'status'        => $status,
                'payment_mode'  => $paymentMode,
                'upi_amount'    => $upiAmount,
                'cash_amount'   => $cashAmount,
            ]);
        }

        $payment->load('collectedBy:id,first_name,last_name');

        return response()->json([
            'status'  => true,
            'message' => $isPartial ? 'Part payment recorded.' : 'Payment marked as collected.',
            'data'    => $payment,
        ]);
    }
}
