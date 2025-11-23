<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramBantuan;
use App\Models\PendaftarBantuan;

class PendaftarBantuanController extends Controller{

    public function about() {
        return view('guest.daftar.about');
    }

    public function home() {
        return view('guest.daftar.home');
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter;

        // 🔥 Normalisasi filter agar "TidakLulus" menggantikan "ditolak"
        if ($filter == "TidakLulus") {
            $filter = "TidakLulus"; 
        }

        $data = PendaftarBantuan::with('program')
            ->when($search, function ($query) use ($search) {
                $query->where('pendaftar_id', 'like', "%$search%")
                      ->orWhere('warga_id', 'like', "%$search%");
            })
            ->when($filter, function ($query) use ($filter) {
                $query->where('status_seleksi', $filter);
            })
            ->orderBy('pendaftar_id', 'DESC')
            ->paginate(6)
            ->withQueryString();

        return view('guest.daftar.index', compact('data', 'search', 'filter'));
    }

    public function create()
    {
        $programs = ProgramBantuan::all();
        return view('guest.daftar.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|numeric',
            'warga_id' => 'required|numeric',
            'status_seleksi' => 'nullable|string',
        ]);

        // 🔥 Ubah "ditolak" jadi "TidakLulus" saat disimpan
        if ($request->status_seleksi == "ditolak") {
            $request['status_seleksi'] = "TidakLulus";
        }

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

        // 🔥 Normalisasi status saat update
        if ($request->status_seleksi == "ditolak") {
            $request['status_seleksi'] = "TidakLulus";
        }

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
