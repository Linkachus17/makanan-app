<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// User Page
// Route::get('/', [HomeController::class, 'index']);
Route::get('/', [MakananController::class, 'index']);
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::get('/checkout-success', function () {
    return view('checkout.success');
});
Route::post('/order', [CheckoutController::class, 'store']);


// Login Page
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Operator Page
Route::middleware(['auth'])->group(function () {
    Route::get('/operator', [OrderController::class, 'index']);
    Route::get('/operator/riwayat', function () {
        return view('operator.riwayat.index');
    });
    Route::get('/operator/makanan', [MakananController::class, 'operator_makanan']);
    Route::post('/operator/makanan', [MakananController::class, 'store']);
    Route::post('/operator/makanan/update', [MakananController::class, 'update'])->name('makanan.update');
    Route::delete('/operator/makanan/{id}', [MakananController::class, 'destroy'])->name('makanan.destroy');
});
