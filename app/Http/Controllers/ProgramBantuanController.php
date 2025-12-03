<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\ProgramBantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramBantuanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $tahun  = $request->tahun;

        $programs = ProgramBantuan::with('media')
            ->when($search, function ($q) use ($search) {
                $q->where('nama_program', 'like', "%$search%")
                  ->orWhere('kode', 'like', "%$search%");
            })
            ->when($tahun, function ($q) use ($tahun) {
                $q->where('tahun', $tahun);
            })
            ->orderBy('program_id', 'DESC')
            ->paginate(6)
            ->withQueryString();

        return view('pages.programbantuan.index', compact('programs', 'search', 'tahun'));
    }

    public function create()
    {
        return view('pages.programbantuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode'         => 'required|unique:program_bantuan',
            'nama_program' => 'required',
            'tahun'        => 'required|digits:4|integer',
            'deskripsi'    => 'nullable|string',
            'anggaran'     => 'required|numeric',
            'media.*'      => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,pdf|max:5120',
        ]);

        // Simpan Program (SERTAKAN DESKRIPSI)
        $program = ProgramBantuan::create($request->only([
            'kode', 'nama_program', 'tahun', 'deskripsi', 'anggaran'
        ]));

        // Upload media
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $index => $file) {

                $path = $file->store('uploads/program_bantuan', 'public');

                Media::create([
                    'ref_table'  => 'program_bantuan',
                    'ref_id'     => $program->program_id,
                    'file_name'  => $path,
                    'mime_type'  => $file->getClientMimeType(),
                    'caption'    => null,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('program_bantuan.index')
            ->with('success', 'Program Bantuan berhasil ditambahkan!');
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
            'kode'         => 'required|unique:program_bantuan,kode,' . $id . ',program_id',
            'nama_program' => 'required',
            'tahun'        => 'required|digits:4|integer',
            'deskripsi'    => 'nullable|string',
            'anggaran'     => 'required|numeric',
            'media.*'      => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,pdf|max:5120',
        ]);

        // Update program (SERTAKAN DESKRIPSI)
        $program->update($request->only([
            'kode', 'nama_program', 'tahun', 'deskripsi', 'anggaran'
        ]));

        // Upload media tambahan
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $index => $file) {

                $path = $file->store('uploads/program_bantuan', 'public');

                Media::create([
                    'ref_table'  => 'program_bantuan',
                    'ref_id'     => $program->program_id,
                    'file_name'  => $path,
                    'mime_type'  => $file->getClientMimeType(),
                    'caption'    => null,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('program_bantuan.index')
            ->with('success', 'Program Bantuan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $program = ProgramBantuan::findOrFail($id);

        // Hapus semua media
        foreach ($program->media as $media) {
            if (Storage::disk('public')->exists($media->file_name)) {
                Storage::disk('public')->delete($media->file_name);
            }
            $media->delete();
        }

        $program->delete();

        return redirect()->route('program_bantuan.index')
            ->with('success', 'Program Bantuan berhasil dihapus!');
    }
}
