<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\PGGroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Imports\MembersImport;
use App\Models\RentPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class MemberController extends Controller
{
    /**
     * List members of logged-in user's PG group
     */
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

        $members = Member::where('pg_group_id', $pgGroupId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $members
        ]);
    }

    /**
     * Store new member
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'first_name' => 'required|string|max:255',

            'last_name' => 'required|string|max:255',

            'phone' => 'required|string|max:20',

            'emergency_contact' => 'required|string|max:20',

            'city' => 'required|string|max:100',

            'room_number' => 'required|string|max:50',

            'bed_sharing' => 'required|integer|min:1|max:20',

            'rent_amount' => 'required|numeric|min:0',

            'email' => 'nullable|email',

            'occupation' => 'nullable|string',

            'remark' => 'nullable|string',

        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $member = Member::create([

            'pg_group_id' => $request->user()->pg_group_id,

            'first_name' => $request->first_name,

            'last_name' => $request->last_name,

            'email' => $request->email,

            'phone' => $request->phone,

            'emergency_contact' => $request->emergency_contact,

            'city' => $request->city,

            'room_number' => $request->room_number,

            'bed_sharing' => $request->bed_sharing,

            'rent_amount' => $request->rent_amount,

            'occupation' => $request->occupation,

            'remark' => $request->remark,

            'is_active' => true

        ]);

        return response()->json([
            'status' => true,
            'message' => 'Member created successfully',
            'data' => $member
        ]);
    }

    public function import(Request $request)
    {
        if (!$request->hasFile('file')) {

            return response()->json([
                'status' => false,
                'message' => 'File missing'
            ], 400);
        }

        $file = fopen($request->file('file'), 'r');

        $header = fgetcsv($file);

        $user = auth()->user();

        while ($row = fgetcsv($file)) {

            Member::create([
                'pg_group_id' => $user->pg_group_id,
                'first_name' => $row[0],
                'last_name' => $row[1],
                'email' => $row[2],
                'phone' => $row[3],
                'emergency_contact' => $row[4],
                'city' => $row[5],
                'room_number' => $row[6],
                'bed_sharing' => $row[7],
                'rent_amount' => $row[8],
                'occupation' => $row[9],
                'remark' => $row[10],
            ]);
        }

        fclose($file);

        return response()->json([
            'status' => true,
            'message' => 'Members imported successfully'
        ]);
    }
    public function downloadSample()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="members_sample.csv"',
        ];

        $columns = [
            'first_name',
            'last_name',
            'email',
            'phone',
            'emergency_contact',
            'city',
            'room_number',
            'bed_sharing',
            'rent_amount',
            'occupation',
            'remark'
        ];

        $callback = function () use ($columns) {

            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    public function destroy($id)
    {
        // Check if target user exists
        $member = Member::find($id);

        if (!$member) {
            return response()->json([
                'message' => 'Member not found'
            ], 404);
        }


        // Delete user
        $member->delete();

        return response()->json([
            'status' => true,
            'message' => 'Member deleted successfully'
        ]);
    }

    public function pendingPayments(Request $request)
    {
        $user = auth()->user();

        $groupUser = PGGroupUser::where('user_id', $user->id)->first();

        if (!$groupUser) {
            return response()->json([
                'status' => false,
                'message' => 'User not linked to any PG group'
            ], 403);
        }

        $pgGroupId = $groupUser->pg_group_id;

        $members = Member::where('pg_group_id', $pgGroupId)
            ->where('is_active', 1)
            ->get();

        $current = Carbon::now()->startOfMonth();

        $result = [];

        foreach ($members as $member) {

            if (!$member->created_at) continue;

            $start = Carbon::parse($member->created_at)->startOfMonth();

            $pendingMonths = 0;

            while ($start <= $current) {

                $paid = RentPayment::where('member_id', $member->id)
                    ->where('pg_group_id', $pgGroupId)
                    ->where('billing_year', $start->year)
                    ->where('billing_month', $start->month)
                    ->whereIn('status', ['paid', 'partial'])  // ← partial = not fully pending
                    ->exists();

                if (!$paid) {
                    $pendingMonths++;
                }

                $start->addMonth();
            }

            if ($pendingMonths > 0) {

                $currentMonthPaid = RentPayment::where('member_id', $member->id)
                    ->where('pg_group_id', $pgGroupId)
                    ->where('billing_year', $current->year)
                    ->where('billing_month', $current->month)
                    ->whereIn('status', ['paid', 'partial'])   // ← same here
                    ->exists();
                

                $result[] = [
                    'member_id'           => $member->id,
                    'first_name'          => $member->first_name,
                    'last_name'           => $member->last_name,
                    'phone'               => $member->phone,
                    'pending_months'      => $pendingMonths,
                    'current_month_pending' => !$currentMonthPaid,  // <-- add this
                ];
            }
        }

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }
    public function collectAllPending(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'required|integer|exists:members,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validator->errors()
            ], 422);
        }

        $user      = auth()->user();
        $groupUser = PGGroupUser::where('user_id', $user->id)->first();

        if (!$groupUser) {
            return response()->json([
                'status'  => false,
                'message' => 'User not linked to any PG group'
            ], 403);
        }

        $pgGroupId = $groupUser->pg_group_id;
        $member    = Member::where('id', $request->member_id)
            ->where('pg_group_id', $pgGroupId)
            ->first();

        if (!$member) {
            return response()->json([
                'status'  => false,
                'message' => 'Member not found'
            ], 404);
        }

        $current = Carbon::now()->startOfMonth();
        $start   = Carbon::parse($member->created_at)->startOfMonth();
        $marked  = 0;

        DB::beginTransaction();
        try {
            while ($start <= $current) {
                $exists = RentPayment::where([
                    'member_id'     => $member->id,
                    'pg_group_id'   => $pgGroupId,
                    'billing_year'  => $start->year,
                    'billing_month' => $start->month,
                ])->first();

                if (!$exists) {
                    // No record at all — create as paid
                    RentPayment::create([
                        'member_id'     => $member->id,
                        'pg_group_id'   => $pgGroupId,
                        'billing_year'  => $start->year,
                        'billing_month' => $start->month,
                        'amount'        => $member->rent_amount,
                        'payment_date'  => Carbon::now()->toDateString(),
                        'payment_month' => $start->format('F Y'),
                        'collected_by'  => $user->id,
                        'status'        => 'paid',
                    ]);
                    $marked++;
                } elseif (in_array($exists->status, ['pending', 'partial'])) {
                    // Existing pending record — update to paid
                    $exists->update([
                        'status'       => 'paid',
                        'payment_date' => Carbon::now()->toDateString(),
                        'collected_by' => $user->id,
                    ]);
                    $marked++;
                }

                $start->addMonth();
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => "{$marked} month(s) marked as paid successfully.",
                'marked'  => $marked,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'  => false,
                'message' => 'Failed to collect payment',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
