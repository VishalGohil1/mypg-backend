<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MemberController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\PartnerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/members', [MemberController::class, 'index']);
    Route::get('/partners', [PartnerController::class, 'index']);

    Route::post('/members', [MemberController::class, 'store']);

    Route::post('/members/import', [MemberController::class, 'import']);
    
    Route::get('/members/sample', [MemberController::class, 'downloadSample']);

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/add-partner', [PartnerController::class, 'store']);
    
});
Route::post('/create-order', [PaymentController::class, 'createOrder']);
Route::post('/verify-payment', [PaymentController::class, 'verifyPayment']);