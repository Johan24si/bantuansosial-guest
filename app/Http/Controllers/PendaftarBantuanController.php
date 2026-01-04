<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Warga;
use Illuminate\Http\Request;
use App\Models\ProgramBantuan;
use App\Models\PendaftarBantuan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PendaftarBantuanController extends Controller
{
    /**
     * Display home page
     */
    public function home()
    {
        return view('guest.daftar.home');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter;

        if ($filter == "ditolak") {
            $filter = "TidakLulus";
        }

        $pendaftar = PendaftarBantuan::with(['program', 'warga', 'media'])
            ->when($search, function ($q) use ($search) {
                $q->where('pendaftar_id', 'like', "%$search%")
                  ->orWhere('warga_id', 'like', "%$search%")
                  ->orWhereHas('warga', function ($query) use ($search) {
                      $query->where('nama', 'like', "%$search%")
                            ->orWhere('no_ktp', 'like', "%$search%");
                  });
            })
            ->when($filter, function ($q) use ($filter) {
                $q->where('status_seleksi', $filter);
            })
            ->orderBy('pendaftar_id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('guest.daftar.index', compact('pendaftar', 'search', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = ProgramBantuan::orderBy('nama_program')->get();
        $wargas = Warga::orderBy('nama')->get();
        
        return view('guest.daftar.create', compact('programs', 'wargas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Debug log
        Log::info('=== STORE METHOD STARTED ===');
        Log::info('Request data:', $request->except('_token'));
        Log::info('Files count:', ['media' => $request->hasFile('media') ? count($request->file('media')) : 0]);

        try {
            // Validasi data
            $validated = $request->validate([
                'program_id' => 'required|exists:program_bantuan,program_id',
                'warga_id' => 'required|exists:warga,warga_id',
                'status_seleksi' => 'required|string|max:255',
                'media' => 'nullable|array',
                'media.*' => 'file|mimes:jpg,jpeg,png,webp,mp4,pdf|max:5120',
            ], [
                'program_id.required' => 'Program bantuan harus dipilih',
                'program_id.exists' => 'Program bantuan tidak valid',
                'warga_id.required' => 'Warga harus dipilih',
                'warga_id.exists' => 'Warga tidak valid',
                'status_seleksi.required' => 'Status seleksi harus diisi',
                'media.*.mimes' => 'Format file harus: JPG, JPEG, PNG, WEBP, MP4, PDF',
                'media.*.max' => 'Ukuran file maksimal 5MB',
            ]);

            Log::info('Validation passed');

            // Simpan data pendaftar
            $pendaftar = PendaftarBantuan::create([
                'program_id' => $validated['program_id'],
                'warga_id' => $validated['warga_id'],
                'status_seleksi' => $validated['status_seleksi'],
            ]);

            Log::info('Pendaftar created with ID: ' . $pendaftar->pendaftar_id);

            // Handle file upload jika ada
            if ($request->hasFile('media')) {
                $sortOrder = 0;
                foreach ($request->file('media') as $file) {
                    $sortOrder++;
                    
                    // Generate unique filename
                    $filename = 'pendaftar_' . $pendaftar->pendaftar_id . '_' . time() . '_' . $sortOrder . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('media/pendaftar', $filename, 'public');
                    
                    // Simpan ke tabel media
                    Media::create([
                        'ref_id' => $pendaftar->pendaftar_id,
                        'ref_table' => 'pendaftar_bantuan',
                        'file_name' => $path,
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type' => $file->getMimeType(),
                        'size' => $file->getSize(),
                        'sort_order' => $sortOrder,
                    ]);
                    
                    Log::info('File saved: ' . $path);
                }
                Log::info('Total files saved: ' . $sortOrder);
            }

            // Redirect ke halaman index dengan success message
            Log::info('=== STORE METHOD COMPLETED SUCCESSFULLY ===');
            
            return redirect()->route('pendaftar.index')
                            ->with('success', 'Data pendaftaran berhasil disimpan!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error: ', $e->errors());
            
            return redirect()->route('pendaftar.create')
                            ->withInput()
                            ->withErrors($e->errors())
                            ->with('error', 'Validasi gagal. Periksa kembali data Anda.');
                            
        } catch (\Exception $e) {
            Log::error('Store error: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());
            
            return redirect()->route('pendaftar.create')
                            ->withInput()
                            ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = PendaftarBantuan::with(['program', 'warga', 'media'])->findOrFail($id);
        $programs = ProgramBantuan::orderBy('nama_program')->get();
        
        return view('guest.daftar.edit', compact('data', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pendaftar = PendaftarBantuan::with('media')->findOrFail($id);

        $validated = $request->validate([
            'program_id' => 'required|exists:program_bantuan,program_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'status_seleksi' => 'required|string|max:255',
            'media' => 'nullable|array',
            'media.*' => 'file|mimes:jpg,jpeg,png,webp,mp4,pdf|max:5120',
        ]);

        // Update data pendaftar
        $pendaftar->update([
            'program_id' => $validated['program_id'],
            'warga_id' => $validated['warga_id'],
            'status_seleksi' => $validated['status_seleksi'],
        ]);

        // Handle file upload jika ada
        if ($request->hasFile('media')) {
            // Hapus file lama jika ada
            foreach ($pendaftar->media as $media) {
                if (Storage::disk('public')->exists($media->file_name)) {
                    Storage::disk('public')->delete($media->file_name);
                }
                $media->delete();
            }

            // Upload file baru
            $sortOrder = 0;
            foreach ($request->file('media') as $file) {
                $sortOrder++;
                
                $filename = 'pendaftar_' . $pendaftar->pendaftar_id . '_' . time() . '_' . $sortOrder . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('media/pendaftar', $filename, 'public');
                
                Media::create([
                    'ref_id' => $pendaftar->pendaftar_id,
                    'ref_table' => 'pendaftar_bantuan',
                    'file_name' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                    'sort_order' => $sortOrder,
                ]);
            }
        }

        return redirect()->route('pendaftar.index')
                        ->with('success', 'Data pendaftaran berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pendaftar = PendaftarBantuan::with('media')->findOrFail($id);

        // Hapus file media
        foreach ($pendaftar->media as $media) {
            if (Storage::disk('public')->exists($media->file_name)) {
                Storage::disk('public')->delete($media->file_name);
            }
            $media->delete();
        }

        // Hapus data pendaftar
        $pendaftar->delete();

        return redirect()->route('pendaftar.index')
                        ->with('success', 'Data pendaftaran berhasil dihapus!');
    }

    /**
     * Show detail pendaftaran
     */
    public function show($id)
    {
        $pendaftar = PendaftarBantuan::with(['program', 'warga', 'media'])->findOrFail($id);
        
        return view('guest.daftar.show', compact('pendaftar'));
    }
}