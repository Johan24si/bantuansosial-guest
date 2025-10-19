<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftarBantuan extends Model
{
    use HasFactory;

    protected $table = 'pendaftar_bantuan'; // pastikan nama tabel benar
    protected $primaryKey = 'pendaftar_id';
    protected $fillable = [
        'program_id',
        'warga_id',
        'status_seleksi',
    ];
}
