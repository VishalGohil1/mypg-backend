<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MemberController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\RentPaymentController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\NoticeController;
use App\Http\Controllers\API\PartnerController;
use App\Http\Controllers\Api\SystemSettingsController;

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
    Route::delete('/partners/{id}', [PartnerController::class, 'destroy']);
    Route::delete('/members/{id}', [MemberController::class, 'destroy']);

    // Route::post('/members/{member}/collect-payment', [MemberController::class, 'collectPayment']);
    Route::get('/rent-payments/monthly-status', [RentPaymentController::class, 'getMonthlyStatus']);
    Route::post('/rent-payments/collect', [RentPaymentController::class, 'collect']);
    Route::get('/rent-payments/pending-members', [MemberController::class, 'pendingPayments']);

    Route::get('/system-settings', [SystemSettingsController::class, 'show']);
    Route::post('/system-settings', [SystemSettingsController::class, 'update']);  
    
    Route::get('/notice-templates', [NoticeController::class,'index']);

    Route::post('/notice-templates', [NoticeController::class,'store']);  
});
Route::post('/create-order', [PaymentController::class, 'createOrder']);
Route::post('/verify-payment', [PaymentController::class, 'verifyPayment']);