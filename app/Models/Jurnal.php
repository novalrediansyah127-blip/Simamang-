<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PesertaMagang;

class Jurnal extends Model
{
    use HasFactory;

    protected $fillable = [
    'peserta_magang_id',
    'nama_file',
    'file_path',
    'tanggal_upload',
    'nilai',
    ];

    protected $casts = [
        'tanggal_upload' => 'datetime',
    ];

    public function peserta()
    {
        return $this->belongsTo(
            PesertaMagang::class,
            'peserta_magang_id'
        );
    }
}