<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramBantuan extends Model
{
    use HasFactory;

    protected $table = 'program_bantuan';
    protected $primaryKey = 'program_id';
    public $timestamps = true;

    protected $fillable = [
        'kode',
        'nama_program',
        'tahun',
        'deskripsi',
        'anggaran',
    ];

    // Relasi ke PendaftarBantuan
    public function pendaftar()
    {
        return $this->hasMany(PendaftarBantuan::class, 'program_id');
    }
    public function media()
{
    return $this->hasMany(\App\Models\Media::class, 'ref_id', 'program_id')
                ->where('ref_table', 'program_bantuan')
                ->orderBy('sort_order', 'ASC');
}
}
