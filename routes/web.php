<?php

use App\Http\Controllers\API\MemberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;  // 👈 add this


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/payment', function () {
    return view('payment');
});

Route::get('/payment-success', function () {
    return view('payment-success');
})->name('payment.success');

Route::get('/payment-failure', function () {
    return view('payment-failure');
})->name('payment.failure');

// Route::get('/payment',[MemberController::class,'payment']);
Route::post('/contact', [ContactController::class, 'store']);  // 👈 add this
