<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftarBantuan extends Model
{
    use HasFactory;

    protected $table = 'pendaftar_bantuan';
    protected $primaryKey = 'pendaftar_id';
    public $timestamps = true;

    protected $fillable = [
        'program_id',
        'warga_id',
        'status_seleksi',
    ];
    public function program()
{
    return $this->belongsTo(ProgramBantuan::class, 'program_id');
}
}
