<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BantuanController extends Controller
{
    public function index()
    {
        // Data contoh bantuan sosial
        $bantuan = [
            'nama_program' => 'Bantuan Sembako 2025',
            'deskripsi'    => 'Program bantuan sosial berupa paket sembako untuk keluarga kurang mampu.',
            'periode'      => 'September - Desember 2025',
        ];

        // Data penerima manfaat
        $penerima = [
            ['nama' => 'Siti Aminah', 'alamat' => 'Jl. Merdeka No. 10', 'status' => 'Aktif'],
            ['nama' => 'Budi Santoso', 'alamat' => 'Jl. Melati No. 5', 'status' => 'Aktif'],
            ['nama' => 'Rina Dewi', 'alamat' => 'Jl. Kenanga No. 3', 'status' => 'Nonaktif'],
        ];

        // Passing ke view
        return view('bantuan', [
            'bantuan' => $bantuan,
            'penerima' => $penerima,
        ]);
    }
}
