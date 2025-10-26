<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('Login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // Contoh login manual sederhana
        if ($request->email === 'johan24si@mahasiswa.pcr.ac.id' && $request->password === '123') {
            // redirect ke home
            return redirect()->route('home');
        }

        return back()->with('error', 'Username atau password salah!');
    }
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:3'
    ]);

    // Simulasi pendaftaran (belum ke database)
    return back()->with('error', 'Akun berhasil dibuat! Silakan login.');
}
}
