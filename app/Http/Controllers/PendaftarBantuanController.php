<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftarBantuan;

class PendaftarBantuanController extends Controller
{
    // ✅ Menampilkan daftar pendaftar (riwayat donasi)
    public function index()
    {
        $warga = PendaftarBantuan::all();
        return view('guest.edit', compact('warga'));
    }

    // ✅ Tampilkan form donasi
    public function create()
    {
        return view('guest.donasi');
    }

    // ✅ Simpan data baru dari form donasi
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'program_id' => 'required|integer',
            'warga_id' => 'required|integer',
            'status_seleksi' => 'nullable|string|max:100',
        ]);

        $pendaftar = PendaftarBantuan::create($validated);

        // Redirect ke halaman riwayat (index)
        return redirect()->route('donasi.index')->with('success', 'Data berhasil disimpan!');
    }

    // ✅ Tampilkan form edit untuk satu data
        public function edit(string $id)
        {
           $warga = PendaftarBantuan::find($id);
    return view('guest.editdata', compact('warga'));
        }

    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $donasi = PendaftaranBantuan::findOrFail($id);
        // Hapus data
        $donasi->delete();
        // Redirect dengan pesan sukses
        return redirect()->route('donasi.index')->with('success', 'Data donasi berhasil dihapus!');
    }
}
