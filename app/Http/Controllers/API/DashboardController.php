<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\PGGroupUser;
use App\Models\RentPayment;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Get PG group from mapping table
        $groupUser = PGGroupUser::where('user_id', $user->id)->first();

        if (!$groupUser) {
            return response()->json([
                'message' => 'User not linked to any PG group'
            ], 403);
        }

        $pgGroupId = $groupUser->pg_group_id;

        // 1️⃣ Total Active Members
        $totalMembers = Member::where('pg_group_id', $pgGroupId)
            ->where('is_active', 1)
            ->count();

        // 2️⃣ Available Rooms
        $rooms = Member::where('pg_group_id', $pgGroupId)
            ->where('is_active', 1)
            ->select('room_number', 'bed_sharing')
            ->get()
            ->groupBy('room_number');

        $availableRooms = 0;

        foreach ($rooms as $members) {
            $capacity = $members->first()->bed_sharing;
            $occupied = $members->count();

            if ($occupied < $capacity) {
                $availableRooms++;
            }
        }

        // 3️⃣ Monthly Revenue
        $monthlyRevenue = RentPayment::where('pg_group_id', $pgGroupId)
            ->where('status', 'paid')
            ->whereMonth('payment_date', now()->month)
            ->whereYear('payment_date', now()->year)
            ->sum('amount');

        return response()->json([
            'total_members'   => $totalMembers,
            'available_rooms' => $availableRooms,
            'monthly_revenue' => $monthlyRevenue,
        ]);
    }
}
