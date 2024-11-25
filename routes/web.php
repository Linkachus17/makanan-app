<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MakananController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/makanan', [MakananController::class, 'index']);
