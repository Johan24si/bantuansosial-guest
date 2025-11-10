<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        // Cek user dari database
        $user = User::where('email', $request->email)->first();

        // Jika user ada dan password cocok
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('home');
        }

        // Gagal
        return back()->with('error', 'Email atau password salah!');
    }

<<<<<<< HEAD
    // Simulasi pendaftaran (belum ke database)
    return back()->with('error', 'Akun berhasil dibuat! Silakan login.');
}
public function logout(Request $request)
    {
         return view('pages.Login');

        $request->session()->invalidate(); // Hapus semua data session
        $request->session()->regenerateToken(); // Regenerasi CSRF token agar aman

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
=======
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3'
        ]);

        // Simpan user baru ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // Hash password biar aman
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
>>>>>>> 0cfebcd1b9ddcc39e876d606f2efc6cd79cf3e49
    }
}
