<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Divisi;
use App\Models\Jurnal;

class PesertaMagang extends Model
{
    use HasFactory;

    protected $fillable = [
    'nama',
    'asal_instansi',
    'jurusan',
    'no_hp',
    'email',
    'divisi_id',
    'tanggal_mulai',
    'tanggal_selesai',
    'status',
    'foto_surat_balasan',
    'foto_surat_sekolah',
    'foto_formal',
];
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function divisi()
    {
        return $this->belongsTo(
            Divisi::class,
            'divisi_id'
        );
    }

    public function jurnal()
    {
        return $this->hasOne(
            Jurnal::class,
            'peserta_magang_id'
        );
    }
}