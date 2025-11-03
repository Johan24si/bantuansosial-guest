<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DataWargaController;
use App\Http\Controllers\PendaftarBantuanController;

// Route login
Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Halaman utama
//Route::get('/index', function() {
    //return view('guest.daftar.index');
//})->name('create');
//Route::get('/home', function() {
    //return view('guest.daftar.home');
//})->name('index');

//ini route guest
Route::get('/home', [PendaftarBantuanController::class, 'home'])->name('guest.daftar.home');
Route::get('/about', [PendaftarBantuanController::class, 'about'])->name('guest.daftar.about');
Route::get('/index', [PendaftarBantuanController::class, 'index'])->name('index');
Route::get('/create', [PendaftarBantuanController::class, 'create'])->name('create');
Route::post('/store', [PendaftarBantuanController::class, 'store'])->name('store');
Route::get('/edit/{id}', [PendaftarBantuanController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [PendaftarBantuanController::class, 'update'])->name('update');
Route::delete('/delete/{id}', [PendaftarBantuanController::class, 'destroy'])->name('delete');



//ini route data warga
Route::get('/warga', [DataWargaController::class, 'index'])->name('warga.index');
Route::get('/warga/create', [DataWargaController::class, 'create'])->name('warga.create');
Route::post('/warga/store', [DataWargaController::class, 'store'])->name('warga.store');
Route::get('/warga/edit/{id}', [DataWargaController::class, 'edit'])->name('warga.edit');
Route::post('/warga/update/{id}', [DataWargaController::class, 'update'])->name('warga.update');
Route::delete('/warga/delete/{id}', [DataWargaController::class, 'destroy'])->name('warga.delete');



//login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::get('/home', function () {
    return view('guest.daftar.home');
})->name('home');

// ini route Users
Route::get('/users', [UsersController::class, 'index'])->name('users.index');
Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
Route::post('/users/update/{id}', [UsersController::class, 'update'])->name('users.update');
Route::delete('/users/delete/{id}', [UsersController::class, 'destroy'])->name('users.destroy');


// Halaman About
Route::get('/about', function () {
    return view('guest.daftar.about');
})->name('about');

// Halaman Pendaftar Bantuan
Route::get('/pendaftar', function () {
    return view('pendaftar.index');
})->name('pendaftar.index');

// Halaman Program Bantuan
Route::get('/program', function () {
    return view('program.index');
})->name('program.index');

// Halaman Verifikasi Lapangan
Route::get('/verifikasi', function () {
    return view('verifikasi.index');
})->name('verifikasi.index');

// Riwayat Penyaluran
// ============================
Route::get('/riwayat', function () {
    return view('riwayat.index');
})->name('riwayat.index');

// ============================
// Penerima Bantuan
// ============================
Route::get('/penerima', function () {
    return view('penerima.index');
})->name('penerima.index');


//Route::resource('Pendaftar', PendaftarBantuanController::class);
