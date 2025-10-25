<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftarBantuan;
use App\Http\Controllers\PendaftarBantuanController;

class PendaftarBantuanController extends Controller{
     public function about() {
    return view('guest.daftar.about');
}
    public function home() {
    return view('guest.daftar.home');
}
    public function index()
    {
        $data = PendaftarBantuan::all();
        return view('guest.daftar.index', compact('data'));
    }
    
    public function create()
    {
        return view('guest.daftar.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|numeric',
            'warga_id' => 'required|numeric',
            'status_seleksi' => 'nullable|string',
        ]);

        PendaftarBantuan::create($request->all());
        return redirect()->route('index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = PendaftarBantuan::findOrFail($id);
        return view('guest.daftar.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'program_id' => 'required|numeric',
            'warga_id' => 'required|numeric',
            'status_seleksi' => 'nullable|string',
        ]);

        $data = PendaftarBantuan::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = PendaftarBantuan::findOrFail($id);
        $data->delete();

        return redirect()->route('index')->with('success', 'Data berhasil dihapus!');
    }
}
