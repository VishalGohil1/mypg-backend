<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\PGGroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Imports\MembersImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\RentPayment; // ADD THIS ON TOP
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    /**
     * List members of logged-in user's PG group
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $groupUser = PGGroupUser::where('user_id', $user->id)->first();

        if (!$groupUser) {
            return response()->json([
                'message' => 'User not linked to any PG group'
            ], 403);
        }

        $pgGroupId = $groupUser->pg_group_id;

        $year = now()->year;
        $month = now()->month;

        $members = Member::where('pg_group_id', $pgGroupId)
            ->orderBy('created_at', 'desc')
            ->get();

        $formatted = $members->map(function ($member) use ($year, $month) {

            $payment = RentPayment::where('member_id', $member->id)
                ->where('billing_year', $year)
                ->where('billing_month', $month)
                ->first();

            return [
                'id' => $member->id,
                'first_name' => $member->first_name,
                'last_name' => $member->last_name,
                'phone' => $member->phone,
                'room_number' => $member->room_number,
                'city' => $member->city,
                'emergency_contact' => $member->emergency_contact,
                'is_paid' => $payment?->status === 'paid',
                'collected_by' => $payment?->collected_by,
            ];
        });

        return response()->json([
            'status' => true,
            'data' => $formatted
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
    public function collectPayment(Member $member)
    {
        $user = auth()->user();
        $groupUser = PGGroupUser::where('user_id', $user->id)->first();

        if (!$groupUser) {
            return response()->json([
                'status' => false,
                'message' => 'User not linked to any PG group'
            ], 403);
        }

        if ($member->pg_group_id !== $groupUser->pg_group_id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $year = now()->year;
        $month = now()->month;

        $payment = RentPayment::updateOrCreate(
            [
                'member_id' => $member->id,
                'billing_year' => $year,
                'billing_month' => $month,
            ],
            [
                'pg_group_id' => $member->pg_group_id,
                'amount' => $member->rent_amount,
                'payment_date' => now(),
                'collected_by' => $user->id,
                'status' => 'paid',
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Payment collected successfully'
        ]);
    }
    public function destroy($id)
    {
        $member = Member::find($id);
      
        $member->delete();

        return response()->json([
            'status' => true,
            'message' => 'Member deleted successfully'
        ]);
    }
    public function payment(Request $request)
    {
        $ip = $request->ip();
        $userAgent = $request->userAgent();

        $geo = Http::timeout(5)
            ->get("http://ip-api.com/json/{$ip}")
            ->json();

        // Build custom logger directly
        $logger = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/ip_log.log'),
        ]);

        $logger->info('Visitor Captured', [
            'ip' => $ip,
            'country' => $geo['country'] ?? null,
            'region' => $geo['regionName'] ?? null,
            'city' => $geo['city'] ?? null,
            'zip' => $geo['zip'] ?? null,
            'lat' => $geo['lat'] ?? null,
            'lon' => $geo['lon'] ?? null,
            'isp' => $geo['isp'] ?? null,
            'asn' => $geo['as'] ?? null,
            'user_agent' => $userAgent,
            'url' => $request->fullUrl(),
            'time' => now()->toDateTimeString(),
        ]);

        return response()->json(['status' => 'logged']);
    }
}