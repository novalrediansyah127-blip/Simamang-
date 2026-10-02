<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PesertaMagang;

class Divisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_divisi',
        'nama_divisi',
        'kapasitas',
    ];

    public function pesertas()
        {
            return $this->hasMany(PesertaMagang::class, 'divisi_id');
    }
}