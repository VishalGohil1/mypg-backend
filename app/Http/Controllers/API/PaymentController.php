<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    private function getRazorpay(): Api
    {
        return new Api(
            config('services.razorpay.key_id'),
            config('services.razorpay.key_secret')
        );
    }

    // POST /api/create-order
    public function createOrder(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            $api = $this->getRazorpay();

            $order = $api->order->create([
                'amount'          => 79900, // ₹799 in paise
                'currency'        => 'INR',
                'receipt'         => 'receipt_user_' . $request->user_id,
                'payment_capture' => 1,
            ]);

            return response()->json([
                'status'   => true,
                'key'      => config('services.razorpay.key_id'),
                'amount'   => $order->amount,
                'currency' => $order->currency,
                'order_id' => $order->id,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Could not create order: ' . $e->getMessage(),
            ], 500);
        }
    }

    // POST /api/verify-payment
    public function verifyPayment(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required',
            'razorpay_order_id'   => 'required',
            'razorpay_signature'  => 'required',
            'user_id'             => 'required|exists:users,id',
        ]);

        try {
            $api = $this->getRazorpay();

            // Verify signature — throws exception if invalid
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature,
            ]);

            // Activate subscription for 1 year
            User::where('id', $request->user_id)->update([
                'account_status'      => 'active',
                'subscription_start'  => now()->toDateString(),
                'subscription_end'    => now()->addYear()->toDateString(),
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Payment verified. Subscription activated.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Payment verification failed: ' . $e->getMessage(),
            ], 400);
        }
    }
}