<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;
    $role   = $request->role; // <-- Tambahan

    $users = User::with('media')
        ->when($search, function ($q) use ($search) {
            $q->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        })
        ->when($role, function ($q) use ($role) {
            $q->where('role', $role);
        })
        ->orderBy('id', 'DESC')
        ->paginate(6)
        ->withQueryString();

    return view('pages.user.index', compact('users', 'search', 'role'));
}

    public function create()
    {
        return view('pages.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'email'       => 'required|email|unique:users',
            'password'    => 'required|min:6',
            'role'        => 'required|in:admin,user', // ⬅️ DITAMBAHKAN
            'media.*'     => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,pdf|max:5120',
        ]);

        // Simpan user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role, // ⬅️ DITAMBAHKAN
        ]);

        // Simpan media
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $index => $file) {

                $path = $file->store('uploads/users', 'public');

                Media::create([
                    'ref_table'  => 'users',
                    'ref_id'     => $user->id,
                    'file_name'  => $path,
                    'mime_type'  => $file->getClientMimeType(),
                    'caption'    => null,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::with('media')->findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'        => 'required',
            'email'       => 'required|email|unique:users,email,' . $id,
            'password'    => 'nullable|min:6',
            'role'        => 'required|in:admin,user', // ⬅️ DITAMBAHKAN
            'media.*'     => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,pdf|max:5120',
        ]);

        // Update user
        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role, // ⬅️ DITAMBAHKAN
            'password' => $request->password
                            ? Hash::make($request->password)
                            : $user->password
        ]);

        // Tambah media baru
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $index => $file) {

                $path = $file->store('uploads/users', 'public');

                Media::create([
                    'ref_table'  => 'users',
                    'ref_id'     => $user->id,
                    'file_name'  => $path,
                    'mime_type'  => $file->getClientMimeType(),
                    'caption'    => null,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus semua media milik user
        foreach ($user->media as $media) {
            if (Storage::disk('public')->exists($media->file_name)) {
                Storage::disk('public')->delete($media->file_name);
            }
            $media->delete();
        }

        // Hapus user
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
