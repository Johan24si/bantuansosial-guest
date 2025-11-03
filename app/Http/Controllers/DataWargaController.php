<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class DataWargaController extends Controller
{
    public function index()
    {
        $data = Warga::orderBy('warga_id', 'DESC')->get();
        return view('pages.warga.index', compact('data'));
    }

    public function create()
    {
        return view('pages.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp|max:20',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'email' => 'nullable|email'
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')->with('success', 'Data Warga berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = Warga::findOrFail($id);
        return view('pages.warga.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Warga::findOrFail($id);

        $request->validate([
            'no_ktp' => 'required|max:20|unique:warga,no_ktp,' . $data->warga_id . ',warga_id',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'email' => 'nullable|email'
        ]);

        $data->update($request->all());

        return redirect()->route('warga.index')->with('success', 'Data Warga berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Warga::findOrFail($id)->delete();
        return redirect()->route('warga.index')->with('success', 'Data Warga berhasil dihapus!');
    }
}
