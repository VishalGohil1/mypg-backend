<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Imports\MembersImport;
use Maatwebsite\Excel\Facades\Excel;


class MemberController extends Controller
{
    /**
     * List members of logged-in user's PG group
     */
    public function index(Request $request)
    {
        $pgGroupId = $request->user()->pg_group_id;

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
}