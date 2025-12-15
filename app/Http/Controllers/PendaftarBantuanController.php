<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\ProgramBantuan;
use App\Models\PendaftarBantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftarBantuanController extends Controller
{
    public function home()
{
    return view('guest.daftar.home');
}
    public function index(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter;

        if ($filter == "ditolak") {
            $filter = "TidakLulus";
        }

        $pendaftar = PendaftarBantuan::with(['program', 'media'])
            ->when($search, function ($q) use ($search) {
                $q->where('pendaftar_id', 'like', "%$search%")
                  ->orWhere('warga_id', 'like', "%$search%");
            })
            ->when($filter, function ($q) use ($filter) {
                $q->where('status_seleksi', $filter);
            })
            ->orderBy('pendaftar_id', 'DESC')
            ->paginate(6)
            ->withQueryString();

        return view('guest.daftar.index', compact('pendaftar', 'search', 'filter'));
    }

    public function create()
    {
        $programs = ProgramBantuan::all();
        return view('guest.daftar.create', compact('programs'));
    }

     public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required',
            'warga_id'   => 'required',
            'status_seleksi' => 'required',
            'foto' => 'nullable|image|max:2048'
        ]);

        // Upload foto
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('pendaftar', 'public');
        } else {
            // Default JPG
            $path = 'default/pendaftar-default.jpg';
        }

        // Simpan data pendaftar
        $pendaftar = PendaftarBantuan::create([
            'program_id' => $request->program_id,
            'warga_id' => $request->warga_id,
            'status_seleksi' => $request->status_seleksi,
        ]);

        // Simpan file ke tabel media (relasi)
        $pendaftar->media()->create([
            'file_name' => $path
        ]);

        return redirect()->back()->with('success', 'Pendaftar berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $pendaftar = PendaftarBantuan::findOrFail($id);

        $validated = $request->validate([
            'program_id' => 'required',
            'warga_id'   => 'required',
            'status_seleksi' => 'required',
            'foto' => 'nullable|image|max:2048'
        ]);

        // Jika upload foto baru
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('pendaftar', 'public');
        } else {
            // Ambil foto lama / default
            $path = $pendaftar->media->first()->file_name ?? 'default/pendaftar-default.jpg';
        }

        $pendaftar->update([
            'program_id' => $request->program_id,
            'warga_id' => $request->warga_id,
            'status_seleksi' => $request->status_seleksi,
        ]);

        // Update media
        $pendaftar->media()->updateOrCreate(
            [],
            ['file_name' => $path]
        );

        return redirect()->back()->with('success', 'Pendaftar berhasil diperbarui!');
    }

    public function edit($id)
    {
        $data = PendaftarBantuan::with('media')->findOrFail($id);
        $programs = ProgramBantuan::all();
        return view('guest.daftar.edit', compact('data', 'programs'));
    }

   

    public function destroy($id)
    {
        $pendaftar = PendaftarBantuan::with('media')->findOrFail($id);

        // HAPUS FILE MEDIA
        foreach ($pendaftar->media as $media) {
            if (Storage::disk('public')->exists($media->file_name)) {
                Storage::disk('public')->delete($media->file_name);
            }
            $media->delete();
        }

        // HAPUS DATA PENDAFTAR
        $pendaftar->delete();

        return redirect()->route('index')->with('success', 'Data berhasil dihapus!');
    }
}
