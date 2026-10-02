<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\PesertaMagang;

class MonitoringController extends Controller
{
    public function index()
    {
        $divisis = Divisi::with('pesertas')->get();

        $totalDivisi = $divisis->count();

        $totalPeserta = PesertaMagang::where('status', 'Aktif')->count();

        $totalKapasitas = $divisis->sum('kapasitas');

        $sisaKuota = $totalKapasitas - $totalPeserta;

        return view('monitoring.index', compact(
            'divisis',
            'totalDivisi',
            'totalPeserta',
            'totalKapasitas',
            'sisaKuota'
        ));
    }


    public function show($id)
{
    $divisi = Divisi::with([
        'pesertas' => function ($query) {
            $query->where('status', 'Aktif')
                  ->orderBy('tanggal_mulai', 'asc');
        }
    ])->findOrFail($id);

    return view('monitoring.show', compact('divisi'));
}
}