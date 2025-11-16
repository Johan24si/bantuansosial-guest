<?php

namespace App\Http\Controllers;

use App\Models\ProgramBantuan;
use Illuminate\Http\Request;

class ProgramBantuanController extends Controller
{
    public function index()
    {
        $programs = ProgramBantuan::all();
        return view('pages.Programbantuan.index', compact('programs'));
    }

    public function create()
    {
        return view('pages.programbantuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:program_bantuan',
            'nama_program' => 'required',
            'tahun' => 'required|digits:4|integer',
            'anggaran' => 'required|numeric',
        ]);

        ProgramBantuan::create($request->all());

        return redirect()->route('program_bantuan.index')->with('success', 'Program Bantuan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $program = ProgramBantuan::findOrFail($id);
        return view('pages.programbantuan.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $program = ProgramBantuan::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:program_bantuan,kode,' . $id . ',program_id',
            'nama_program' => 'required',
            'tahun' => 'required|digits:4|integer',
            'anggaran' => 'required|numeric',
        ]);

        $program->update($request->all());

        return redirect()->route('program_bantuan.index')->with('success', 'Program Bantuan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        ProgramBantuan::destroy($id);
        return redirect()->route('program_bantuan.index')->with('success', 'Program Bantuan berhasil dihapus!');
    }
}
