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
        $request->validate([
            'program_id'     => 'required|numeric',
            'warga_id'       => 'required|numeric',
            'status_seleksi' => 'nullable|string',
            'media.*'        => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,pdf|max:5120',
        ]);

        if ($request->status_seleksi == "ditolak") {
            $request['status_seleksi'] = "TidakLulus";
        }

        // SIMPAN PENDAFTAR
        $pendaftar = PendaftarBantuan::create($request->only([
            'program_id',
            'warga_id',
            'status_seleksi',
        ]));

        // UPLOAD MEDIA
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $index => $file) {

                $path = $file->store('uploads/pendaftar_bantuan', 'public');

                Media::create([
                    'ref_table'  => 'pendaftar_bantuan',
                    'ref_id'     => $pendaftar->pendaftar_id,
                    'file_name'  => $path,
                    'mime_type'  => $file->getClientMimeType(),
                    'caption'    => null,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = PendaftarBantuan::with('media')->findOrFail($id);
        $programs = ProgramBantuan::all();
        return view('guest.daftar.edit', compact('data', 'programs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'program_id'     => 'required|numeric',
            'warga_id'       => 'required|numeric',
            'status_seleksi' => 'nullable|string',
            'media.*'        => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,pdf|max:5120',
        ]);

        if ($request->status_seleksi == "ditolak") {
            $request['status_seleksi'] = "TidakLulus";
        }

        $pendaftar = PendaftarBantuan::findOrFail($id);
        $pendaftar->update($request->only([
            'program_id',
            'warga_id',
            'status_seleksi'
        ]));

        // UPLOAD MEDIA TAMBAHAN
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $index => $file) {

                $path = $file->store('uploads/pendaftar_bantuan', 'public');

                Media::create([
                    'ref_table'  => 'pendaftar_bantuan',
                    'ref_id'     => $pendaftar->pendaftar_id,
                    'file_name'  => $path,
                    'mime_type'  => $file->getClientMimeType(),
                    'caption'    => null,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('index')->with('success', 'Data berhasil diperbarui!');
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
