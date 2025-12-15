<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DataWargaController;
use App\Http\Controllers\ProgramBantuanController;
use App\Http\Controllers\PenerimaBantuanController;
use App\Http\Controllers\PendaftarBantuanController;

// Route login
Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);

// ===============================
// ROUTE GUEST (TANPA LOGIN)
// ===============================
Route::get('/home', [PendaftarBantuanController::class, 'home'])->name('guest.daftar.home');
Route::get('/about', [PendaftarBantuanController::class, 'about'])->name('guest.daftar.about');
Route::get('/index', [PendaftarBantuanController::class, 'index'])->name('index');
Route::get('/create', [PendaftarBantuanController::class, 'create'])->name('create');
Route::post('/store', [PendaftarBantuanController::class, 'store'])->name('store');
Route::get('/edit/{id}', [PendaftarBantuanController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [PendaftarBantuanController::class, 'update'])->name('update');
Route::delete('/delete/{id}', [PendaftarBantuanController::class, 'destroy'])->name('delete');

// ===============================
// LOGIN & REGISTER
// ===============================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ===================================================
// ROUTE YANG WAJIB LOGIN (DIBUNGKUS MIDDLEWARE)
// ===================================================
Route::middleware(['checkislogin'])->group(function () {

    // Home setelah login
    Route::get('/home', function () {
        return view('guest.daftar.home');
    })->name('home')->middleware('auth');

    // Profile
    Route::get('/profile', function () {
        return "Halaman Profile";
    })->name('profile')->middleware('auth');

    // ===============================
    // DATA WARGA
    // ===============================
    Route::get('/warga', [DataWargaController::class, 'index'])
        ->name('warga.index')
        ->middleware('checkrole:admin');

    Route::get('/warga/create', [DataWargaController::class, 'create'])
        ->name('warga.create')
        ->middleware('checkrole:admin');

    Route::post('/warga/store', [DataWargaController::class, 'store'])
        ->name('warga.store')
        ->middleware('checkrole:admin');

    Route::get('/warga/edit/{id}', [DataWargaController::class, 'edit'])
        ->name('warga.edit')
        ->middleware('checkrole:admin');

    Route::post('/warga/update/{id}', [DataWargaController::class, 'update'])
        ->name('warga.update')
        ->middleware('checkrole:admin');

    Route::delete('/warga/delete/{id}', [DataWargaController::class, 'destroy'])
        ->name('warga.delete')
        ->middleware('checkrole:admin');

    // ===============================
    // USERS
    // ===============================
    Route::get('/users', [UsersController::class, 'index'])
        ->name('users.index');
       

    Route::get('/users/create', [UsersController::class, 'create'])
        ->name('users.create')
        ->middleware('checkrole:admin');

    Route::post('/users/store', [UsersController::class, 'store'])
        ->name('users.store')
        ->middleware('checkrole:admin');

    Route::get('/users/edit/{id}', [UsersController::class, 'edit'])
        ->name('users.edit')
        ->middleware('checkrole:admin');

    Route::put('/users/update/{id}', [UsersController::class, 'update'])
        ->name('users.update')
        ->middleware('checkrole:admin');

    Route::delete('/users/delete/{id}', [UsersController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('checkrole:admin');

    // ===============================
    // PROGRAM BANTUAN
    // ===============================
    Route::get('/program_bantuan', [ProgramBantuanController::class, 'index'])
        ->name('program_bantuan.index');
        

    Route::get('/program_bantuan/create', [ProgramBantuanController::class, 'create'])
        ->name('program_bantuan.create')
        ->middleware('checkrole:admin');

    Route::post('/program_bantuan/store', [ProgramBantuanController::class, 'store'])
        ->name('program_bantuan.store')
        ->middleware('checkrole:admin');

    Route::get('/program_bantuan/edit/{id}', [ProgramBantuanController::class, 'edit'])
        ->name('program_bantuan.edit')
        ->middleware('checkrole:admin');

    Route::put('/program_bantuan/update/{id}', [ProgramBantuanController::class, 'update'])
        ->name('program_bantuan.update')
        ->middleware('checkrole:admin');

    Route::delete('/program_bantuan/delete/{id}', [ProgramBantuanController::class, 'destroy'])
        ->name('program_bantuan.destroy')
        ->middleware('checkrole:admin');

    // ===============================
    // ADMIN - PENDAFTAR
    // ===============================
    Route::get('/pendaftar', [PendaftarBantuanController::class, 'index'])
        ->name('pendaftar.index');
     

    // Verifikasi
    Route::get('/verifikasi', function () {
        return view('verifikasi.index');
    })->name('verifikasi.index')->middleware('checkrole:admin');

    // Riwayat
    Route::get('/riwayat', function () {
        return view('riwayat.index');
    })->name('riwayat.index')->middleware('checkrole:admin');

    // Penerima
    Route::get('/penerima', function () {
        return view('penerima.index');
    })->name('penerima.index')->middleware('checkrole:admin');
});

// Halaman About (tetap jadi guest)
Route::get('/about', function () {
    return view('guest.daftar.about');
})->name('about');

// route logout (ganda tetap dipertahankan)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/penerima_bantuan', [PenerimaBantuanController::class, 'index'])
    ->name('penerima_bantuan.index');

Route::get('/penerima_bantuan/create', [PenerimaBantuanController::class, 'create'])
    ->name('penerima_bantuan.create')
    ->middleware('checkrole:admin');

Route::post('/penerima_bantuan/store', [PenerimaBantuanController::class, 'store'])
    ->name('penerima_bantuan.store')
    ->middleware('checkrole:admin');

Route::get('/penerima_bantuan/edit/{id}', [PenerimaBantuanController::class, 'edit'])
    ->name('penerima_bantuan.edit')
    ->middleware('checkrole:admin');

Route::put('/penerima_bantuan/update/{id}', [PenerimaBantuanController::class, 'update'])
    ->name('penerima_bantuan.update')
    ->middleware('checkrole:admin');

Route::delete('/penerima_bantuan/delete/{id}', [PenerimaBantuanController::class, 'destroy'])
    ->name('penerima_bantuan.destroy')
    ->middleware('checkrole:admin');
