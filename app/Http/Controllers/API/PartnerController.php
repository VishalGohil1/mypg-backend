<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PgGroup;
use Illuminate\Http\Request;
use App\Models\PGGroupUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Get PG group mapping
        $groupUser = PGGroupUser::where('user_id', $user->id)->first();

        if (!$groupUser) {
            return response()->json([
                'message' => 'User not linked to any PG group'
            ], 403);
        }

        // // Only owner can view partner list
        // if ($groupUser->role !== 'owner') {
        //     return response()->json([
        //         'message' => 'Only owner can view partners'
        //     ], 403);
        // }

        $pgGroupId = $groupUser->pg_group_id;

        // Get all partner user IDs from mapping table
        $partnerIds = PGGroupUser::where('pg_group_id', $pgGroupId)
            // ->where('role', 'partner')
            ->pluck('user_id');

        // Fetch partner details
        $partners = User::whereIn('id', $partnerIds)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $partners
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:6',
        ]);

        $owner = auth()->user();

        // Check if logged in user is owner of a PG
        $group = PgGroup::where('owner_id', $owner->id)->first();

        if (!$group) {
            return response()->json([
                'message' => 'Only owner can add partner'
            ], 403);
        }

        DB::beginTransaction();

        try {

            // Create partner user
            $partner = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'account_status' => 'active',
            ]);

            // Attach to PG group
            PGGroupUser::create([
                'pg_group_id' => $group->id,
                'user_id'     => $partner->id,
                'role'        => 'partner'
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Partner created successfully'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Something went wrong',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}