<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index']);
Route::get('/makanan', [MakananController::class, 'index']);
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::get('/order', [OrderController::class, 'index']);