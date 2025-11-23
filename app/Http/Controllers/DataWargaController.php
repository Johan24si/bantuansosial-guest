<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class DataWargaController extends Controller
{
    public function index(Request $request)
    {
        $query = Warga::orderBy('warga_id', 'DESC');

        // FILTER JENIS KELAMIN
        if ($request->jenis_kelamin) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // SEARCH NAMA / NIK
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('no_ktp', 'LIKE', '%' . $request->search . '%');
            });
        }

        // PAGINATION (6 DATA PER PAGE)
        $data = $query->paginate(6);

        return view('pages.warga.index', compact('data'))
                ->with('search', $request->search)
                ->with('jenis_kelamin', $request->jenis_kelamin);
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
