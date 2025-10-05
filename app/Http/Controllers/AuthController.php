<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('login-form');
    }

    // Memproses form login
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Validasi username & password wajib diisi
        if (empty($username) || empty($password)) {
            return redirect('/auth')->with('error', 'Username dan password wajib diisi.');
        }

        // Password minimal 3 karakter dan mengandung huruf kapital
        if (strlen($password) < 3 || !preg_match('/[A-Z]/', $password)) {
            return redirect('/auth')->with('error', 'Password harus minimal 3 karakter dan mengandung huruf kapital.');
        }

        // Contoh data login sederhana
        if ($username === 'johan24si@mahasiswa.pcr.ac.id' && $password === 'Jojo') {
            return redirect('/auth/success');
        } else {
            return redirect('/auth')->with('error', 'Username atau password salah.');
        }
    }
}
