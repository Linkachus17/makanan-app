<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', [HomeController::class, 'index']);
Route::get('/', [MakananController::class, 'index']);
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::get('/checkout-success', function () {
    return view('checkout.success');
});
Route::post('/order', [CheckoutController::class, 'store']);

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/operator', [OrderController::class, 'index']);
    Route::get('/operator-riwayat', function () {
        return view('operator.riwayat');
    });
    Route::get('/operator-makanan', function () {
        return view('operator.makanan');
    });
});
