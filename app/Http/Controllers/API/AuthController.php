<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\PgGroup;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    // LOGIN
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }
        
        $user = User::where('email', $request->email)->first();
  if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }
        // Block if account not active
      if ($user->account_status !== 'active') {
        return response()->json([
            'status' => false,
            'message' => 'Subscription not active. Please complete payment.',
            'user_id' => $user->id
        ], 403);
    }
    if ($user->subscription_end && now()->gt($user->subscription_end)) {

        $user->account_status = 'expired';
        $user->save();

        return response()->json([
            'status' => false,
            'message' => 'Subscription expired. Please renew.'
        ], 403);
    }
      

        // remove old tokens
        $user->tokens()->delete();

        // create new token
        $token = $user->createToken('MyPGToken')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ]);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'pg_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'password' => 'required|min:6',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {

            // 1. Create User
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'city' => $request->city,
                'password' => Hash::make($request->password),
            ]);

            // 2. Create PG Group
            $pgGroup = PgGroup::create([
                'name' => $request->pg_name,
                'owner_id' => $user->id,
            ]);
            $user->pg_group_id = $pgGroup->id;
            $user->save();

            // 3. Assign user as owner in pg_group_users
            DB::table('pg_group_users')->insert([
                'pg_group_id' => $pgGroup->id,
                'user_id' => $user->id,
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

           return response()->json([
                'status' => true,
                'message' => 'Registration successful. Please complete payment.',
                'user_id' => $user->id
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ]);
        }
    }
}