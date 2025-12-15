<?php

namespace App\Http\Controllers;

use App\Models\PenerimaBantuan;
use App\Models\ProgramBantuan;
use App\Models\Warga;
use Illuminate\Http\Request;

class PenerimaBantuanController extends Controller
{
    public function index(Request $request)
    {
        $query = PenerimaBantuan::with(['program', 'warga']);
        
        // Search berdasarkan nama warga
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('warga', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }
        
        // Filter berdasarkan program bantuan
        if ($request->has('program') && !empty($request->program)) {
            $query->where('program_id', $request->program);
        }
        
        // Pagination dengan 10 data per halaman
        $data = $query->paginate(10)->withQueryString();
        
        // Ambil semua program untuk dropdown filter
        $programs = ProgramBantuan::all();
        
        return view('guest.penerimabantuan.index', compact('data', 'programs'));
    }

    public function create()
    {
        $program = ProgramBantuan::all();
        $warga   = Warga::all();
        return view('guest.penerimabantuan.create', compact('program', 'warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:program_bantuan,program_id',
            'warga_id'   => 'required|exists:warga,warga_id',
            'keterangan' => 'nullable|string|max:255',
        ]);

        PenerimaBantuan::create($request->all());

        return redirect()->route('penerima_bantuan.index')
                         ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data    = PenerimaBantuan::findOrFail($id);
        $program = ProgramBantuan::all();
        $warga   = Warga::all();

        return view('guest.penerimabantuan.edit', compact('data','program','warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'program_id' => 'required|exists:program_bantuan,program_id',
            'warga_id'   => 'required|exists:warga,warga_id',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $data = PenerimaBantuan::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('penerima_bantuan.index')
                         ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        PenerimaBantuan::findOrFail($id)->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}