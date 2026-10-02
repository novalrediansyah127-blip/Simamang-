<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\PesertaMagang;
use App\Http\Controllers\DashboardController;
class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua divisi dan hitung peserta yang MASIH AKTIF
        $divisis = Divisi::withCount([
            'pesertas as peserta_magangs_count' => function ($query) {
                $query->where('status', 'Aktif');
            }
        ])->get();

        // Total divisi
        $totalDivisi = $divisis->count();

        // Total peserta aktif
        $totalPesertaAktif = PesertaMagang::where('status', 'Aktif')->count();

        // Total peserta selesai
        $totalPesertaSelesai = PesertaMagang::where('status', 'Selesai')->count();

        // Total seluruh kapasitas divisi
        $totalKapasitas = $divisis->sum('kapasitas');

        // Total kuota yang sedang terpakai
        $totalTerisi = $divisis->sum('peserta_magangs_count');

        // Sisa kuota
        $sisaKuota = max($totalKapasitas - $totalTerisi, 0);

        // ==========================================
        // TAMBAHAN UNTUK CHART PRESENSI/PERSENTASE
        // ==========================================
        $chartLabels = [];
        $chartData = [];

        foreach ($divisis as $divisi) {
            $chartLabels[] = $divisi->nama_divisi;
            
            // Hitung persentase keterisian per divisi berdasarkan total peserta aktif keseluruhan
            if ($totalPesertaAktif > 0) {
                $persentase = round(($divisi->peserta_magangs_count / $totalPesertaAktif) * 100);
            } else {
                $persentase = 0;
            }
            
            $chartData[] = $persentase;
        }

        return view(
            'admin.dashboard',
            compact(
                'divisis',
                'totalDivisi',
                'totalPesertaAktif',
                'totalPesertaSelesai',
                'sisaKuota',
                'totalKapasitas',
                'totalTerisi',
                'chartLabels',
                'chartData'
            )
        );
    }
}
    