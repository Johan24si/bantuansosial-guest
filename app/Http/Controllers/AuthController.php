<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('pages.Login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // Cek user
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user);

            // ✔ Ambil foto dari tabel media
            $mediaPhoto = Media::where('ref_table', 'users')
                ->where('ref_id', $user->id)
                ->orderBy('sort_order')
                ->value('file_name'); // hanya ambil 1 foto

            // ✔ Simpan seluruh data user + foto ke session
            session([
                'user' => (object)[
                    'id'          => $user->id,
                    'name'        => $user->name,
                    'email'       => $user->email,
                    'media_photo' => $mediaPhoto // BISA NULL kalau tidak ada foto
                ]
            ]);

            return redirect()->route('home');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|',
            'password' => 'required|'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    public function logout()
    {
        Auth::logout();
        session()->forget('user');
        return redirect()->route('login');
    }
}
