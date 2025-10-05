<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BantuanController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/bantuan', [BantuanController::class, 'index']);






Route::get('/auth', [AuthController::class, 'index']);      // Menampilkan form login
Route::post('/auth/login', [AuthController::class, 'login']); // Memproses form login
Route::get('/auth/success', function () {
    return view('success');
});


