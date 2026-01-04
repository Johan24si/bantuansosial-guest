<?php

namespace App\Models;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
public function warga()
{
    return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
}
public function media()
{
    return $this->hasMany(Media::class, 'ref_id', 'pendaftar_id')
                ->where('ref_table', 'pendaftar_bantuan')
                ->orderBy('sort_order', 'ASC');
}
}
