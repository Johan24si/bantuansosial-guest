<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftarBantuanController;

// Route login
Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Halaman utama
Route::get('/home', function() {
    return view('guest.index');
})->name('index');

// ✅ Route untuk Donasi
Route::get('/donasi', [PendaftarBantuanController::class, 'create'])->name('donasi.create');
Route::post('/donasi', [PendaftarBantuanController::class, 'store'])->name('donasi.store');
Route::get('/riwayat', [PendaftarBantuanController::class, 'index'])->name('donasi.index');
Route::get('/donasi/edit/{pendaftar_id}', [PendaftarBantuanController::class, 'edit'])->name('donasi.edit');
Route::delete('/donasi', [DonasiController::class, 'destroy'])->name('donasi.destroy');