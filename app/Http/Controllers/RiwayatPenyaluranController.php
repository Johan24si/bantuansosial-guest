<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPenyaluranBantuan;
use App\Models\ProgramBantuan;
use App\Models\PenerimaBantuan;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RiwayatPenyaluranController extends Controller
{
    // =========================
    // INDEX
    // =========================
    public function index(Request $request)
    {
        $search     = $request->search;
        $program_id = $request->program_id;

        $data = RiwayatPenyaluranBantuan::with(['program', 'penerima', 'media'])
            ->when($search, function ($q) use ($search) {
                $q->where('tahap_ke', 'like', "%$search%")
                  ->orWhere('nilai', 'like', "%$search%");
            })
            ->when($program_id, function ($q) use ($program_id) {
                $q->where('program_id', $program_id);
            })
            ->orderBy('penyaluran_id', 'DESC')
            ->paginate(6)
            ->withQueryString();

        $program = ProgramBantuan::all();

        return view('pages.riwayatpenyaluran.index', compact(
            'data', 'search', 'program_id', 'program'
        ));
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        return view('pages.riwayatpenyaluran.create', [
            'program'  => ProgramBantuan::all(),
            'penerima' => PenerimaBantuan::all(),
        ]);
    }

    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'program_id'  => 'required',
            'penerima_id' => 'required',
            'tahap_ke'    => 'required|integer',
            'tanggal'     => 'required|date',
            'nilai'       => 'required|numeric',
            'media.*'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $riwayat = RiwayatPenyaluranBantuan::create([
            'program_id'  => $request->program_id,
            'penerima_id' => $request->penerima_id,
            'tahap_ke'    => $request->tahap_ke,
            'tanggal'     => $request->tanggal,
            'nilai'       => $request->nilai,
        ]);

        // SIMPAN MEDIA
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $index => $file) {

                $path = $file->store('riwayat_penyaluran', 'public');

                Media::create([
                    'ref_table' => 'riwayat_penyaluran',
                    'ref_id'    => $riwayat->penyaluran_id,
                    'file_name' => $path,
                    'caption'   => 'Bukti Penyaluran',
                    'mime_type' => $file->getClientMimeType(),
                    'sort_order'=> $index + 1,
                ]);
            }
        }

        return redirect()->route('riwayat_penyaluran.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        return view('pages.riwayatpenyaluran.edit', [
            'item'     => RiwayatPenyaluranBantuan::with('media')->findOrFail($id),
            'program'  => ProgramBantuan::all(),
            'penerima' => PenerimaBantuan::all(),
        ]);
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'program_id'  => 'required',
            'penerima_id' => 'required',
            'tahap_ke'    => 'required|integer',
            'tanggal'     => 'required|date',
            'nilai'       => 'required|numeric',
            'media.*'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $riwayat = RiwayatPenyaluranBantuan::findOrFail($id);

        $riwayat->update([
            'program_id'  => $request->program_id,
            'penerima_id' => $request->penerima_id,
            'tahap_ke'    => $request->tahap_ke,
            'tanggal'     => $request->tanggal,
            'nilai'       => $request->nilai,
        ]);

        // TAMBAH MEDIA BARU (TIDAK MENGHAPUS YANG LAMA)
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $index => $file) {

                $path = $file->store('riwayat_penyaluran', 'public');

                Media::create([
                    'ref_table' => 'riwayat_penyaluran',
                    'ref_id'    => $riwayat->penyaluran_id,
                    'file_name' => $path,
                    'caption'   => 'Bukti Penyaluran',
                    'mime_type' => $file->getClientMimeType(),
                    'sort_order'=> $index + 1,
                ]);
            }
        }

        return redirect()->route('riwayat_penyaluran.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    // =========================
    // DESTROY
    // =========================
    public function destroy($id)
    {
        $riwayat = RiwayatPenyaluranBantuan::with('media')->findOrFail($id);

        // HAPUS FILE MEDIA
        foreach ($riwayat->media as $media) {
            Storage::disk('public')->delete($media->file_name);
            $media->delete();
        }

        $riwayat->delete();

        return back()->with('success', 'Data & media berhasil dihapus');
    }
    public function deleteMedia($id, $media_id)
{
    $riwayat = RiwayatPenyaluranBantuan::findOrFail($id);
    $media = Media::where('media_id', $media_id)
        ->where('ref_table', 'riwayat_penyaluran')
        ->where('ref_id', $id)
        ->firstOrFail();

    Storage::disk('public')->delete($media->file_name);
    $media->delete();

    return back()->with('success', 'Media berhasil dihapus');
}
    
}
