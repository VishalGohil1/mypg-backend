<?php
namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\NoticeTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $templates = NoticeTemplate::where(
            'pg_group_id',
            $user->pg_group_id
        )->latest()->get();

        return response()->json($templates);
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $user = Auth::user();

        $notice = NoticeTemplate::create([
            'pg_group_id' => $user->pg_group_id,
            'subject' => $request->subject,
            'description' => $request->description
        ]);

        return response()->json([
            'message' => 'Notice created',
            'data' => $notice
        ]);
    }

}