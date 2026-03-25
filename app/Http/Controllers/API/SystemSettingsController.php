<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PgGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemSettingsController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $pg = PgGroup::findOrFail($user->pg_group_id);

       return response()->json([
            'hostel_name' => $pg->hostel_name,
            'available_beds' => $pg->available_beds
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'hostel_name' => 'required|string|max:255',
            'available_beds' => 'required|integer|min:0'
        ]);
        $user = Auth::user();

        $pg = PgGroup::findOrFail($user->pg_group_id);
        $pg->update([
            'hostel_name' => $request->hostel_name,
            'available_beds' => $request->available_beds
        ]);

        return response()->json([
            'message' => 'System settings updated successfully'
        ]);
    }
}