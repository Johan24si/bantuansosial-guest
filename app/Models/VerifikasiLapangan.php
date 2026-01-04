<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerifikasiLapangan extends Model 
{
    use HasFactory;

    protected $table = 'verifikasi_lapangan';
    protected $primaryKey = 'verifikasi_id';

    protected $fillable = [
        'pendaftar_id',
        'petugas',
        'tanggal',
        'catatan',
        'skor'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(PendaftarBantuan::class, 'pendaftar_id');
    }

    // PERBAIKAN: Relasi media yang benar
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'verifikasi_id')
                    ->where('ref_table', 'verifikasi_lapangan')
                    ->orderBy('sort_order', 'ASC');
    }
}