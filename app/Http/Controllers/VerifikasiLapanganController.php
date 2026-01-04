<?php

namespace App\Http\Controllers;

use App\Models\VerifikasiLapangan;
use App\Models\PendaftarBantuan;
use Illuminate\Http\Request;
use App\Models\Media;
class VerifikasiLapanganController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->search;
        $tanggal = $request->tanggal;

        $data = VerifikasiLapangan::with(['media', 'pendaftar'])
            ->when($search, function ($q) use ($search) {
                $q->where('petugas', 'like', "%$search%")
                  ->orWhere('catatan', 'like', "%$search%");
            })
            ->when($tanggal, function ($q) use ($tanggal) {
                $q->whereDate('tanggal', $tanggal);
            })
            ->orderBy('verifikasi_id', 'DESC')
            ->paginate(6)
            ->withQueryString();

        return view('pages.verifikasi.index', compact('data', 'search', 'tanggal'));
    }

    public function create()
    {
        $pendaftar = PendaftarBantuan::all();
        return view('pages.verifikasi.create', compact('pendaftar'));
    }

   


public function store(Request $request)
{
    $request->validate([
        'pendaftar_id' => 'required|exists:pendaftar_bantuan,pendaftar_id',
        'petugas'      => 'required|string',
        'tanggal'      => 'required|date',
        'catatan'      => 'nullable|string',
        'skor'         => 'nullable|integer',
        'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $verifikasi = VerifikasiLapangan::create(
        $request->except('foto')
    );

    // ✅ SIMPAN FOTO MANUAL
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $path = $file->store('verifikasi', 'public');

        Media::create([
            'ref_table'  => 'verifikasi_lapangan',
            'ref_id'     => $verifikasi->verifikasi_id,
            'file_name' => $path,
            'mime_type' => $file->getClientMimeType(),
            'sort_order'=> 1,
        ]);
    }

    return redirect()
        ->route('pages.verifikasi.index')
        ->with('success', 'Data verifikasi berhasil disimpan');
}


    public function edit($id)
    {
        $verifikasi = VerifikasiLapangan::findOrFail($id);
        $pendaftar  = PendaftarBantuan::all();

        return view(
            'pages.verifikasi.edit',
            compact('verifikasi', 'pendaftar')
        );
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'pendaftar_id' => 'exists:pendaftar_bantuan,pendaftar_id',
        'petugas'      => 'required|string',
        'tanggal'      => 'required|date',
        'catatan'      => 'nullable|string',
        'skor'         => 'nullable|integer',
        'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $verifikasi = VerifikasiLapangan::findOrFail($id);
    $verifikasi->update($request->except('foto'));

    if ($request->hasFile('foto')) {

        // hapus media lama
        Media::where('ref_table', 'verifikasi_lapangan')
            ->where('ref_id', $verifikasi->verifikasi_id)
            ->delete();

        $file = $request->file('foto');
        $path = $file->store('verifikasi', 'public');

        Media::create([
            'ref_table'  => 'verifikasi_lapangan',
            'ref_id'     => $verifikasi->verifikasi_id,
            'file_name' => $path,
            'mime_type' => $file->getClientMimeType(),
            'sort_order'=> 1,
        ]);
    }

    return redirect()
        ->route('pages.verifikasi.index')
        ->with('success', 'Data verifikasi berhasil diupdate');
}


    public function destroy($id)
    {
        $verifikasi = VerifikasiLapangan::findOrFail($id);
        $verifikasi->delete();

        return back()->with('success', 'Data verifikasi berhasil dihapus');
    }
}
