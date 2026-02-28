<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\User;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($request->user_id);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {

            $order = $api->order->create([
                'receipt' => 'receipt_'.$user->id,
                'amount' => 79900, // ₹799 in paise
                'currency' => 'INR'
            ]);

            // Save order ID
            $user->razorpay_order_id = $order['id'];
            $user->save();

            return response()->json([
                'status' => true,
                'order_id' => $order['id'],
                'key' => env('RAZORPAY_KEY'),
                'amount' => 79900,
                'currency' => 'INR'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Unable to create order'
            ], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required',
            'razorpay_order_id' => 'required',
            'razorpay_signature' => 'required'
        ]);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {

            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // 🔥 VERY IMPORTANT — find user by order_id
            $user = User::where('razorpay_order_id', $request->razorpay_order_id)
                        ->firstOrFail();

            $user->account_status = 'active';
            $user->subscription_start = now();
            $user->subscription_end = now()->addYear();
            $user->razorpay_payment_id = $request->razorpay_payment_id;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Subscription activated successfully'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Payment verification failed'
            ], 400);
        }
    }
}