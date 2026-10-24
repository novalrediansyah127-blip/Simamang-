<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\PesertaMagang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    // 1. Ambil input periode (format: YYYY-MM), jika kosong gunakan bulan & tahun saat ini
    $selectedPeriode = $request->input('periode', date('Y-m'));
    
    // 2. Pecah string "YYYY-MM" menjadi tahun dan bulan terpisah
    $pecahPeriode = explode('-', $selectedPeriode);
    $selectedTahun = $pecahPeriode[0] ?? date('Y');
    $selectedBulan = $pecahPeriode[1] ?? date('m');

    // 3. Hitung peserta aktif/booking pada bulan & tahun tersebut
    $divisis = Divisi::withCount([
        'pesertas as peserta_magangs_count' => function ($query) use ($selectedBulan, $selectedTahun) {
            $query->where('status', '!=', 'Selesai')
                  ->whereYear('tanggal_mulai', '<=', $selectedTahun)
                  ->whereMonth('tanggal_mulai', '<=', $selectedBulan)
                  ->whereYear('tanggal_selesai', '>=', $selectedTahun)
                  ->whereMonth('tanggal_selesai', '>=', $selectedBulan);
        }
    ])->get();

    // 4. Total divisi
    $totalDivisi = Divisi::count();
    
    // 5. Total peserta aktif berdasarkan filter periode
    $totalPesertaAktif = PesertaMagang::where('status', '!=', 'Selesai')
        ->whereYear('tanggal_mulai', '<=', $selectedTahun)
        ->whereMonth('tanggal_mulai', '<=', $selectedBulan)
        ->whereYear('tanggal_selesai', '>=', $selectedTahun)
        ->whereMonth('tanggal_selesai', '>=', $selectedBulan)
        ->count();
        
    // 6. Total peserta selesai (keseluruhan)
    $totalPesertaSelesai = PesertaMagang::where('status', 'Selesai')->count();

    // 7. Kapasitas & Terisi
    $totalKapasitas = $divisis->sum('kapasitas');
    $totalTerisi = $divisis->sum('peserta_magangs_count');
    $sisaKuota = max($totalKapasitas - $totalTerisi, 0);

    // ==========================================
    // CHART PERSENTASE
    // ==========================================
    $chartLabels = [];
    $chartData = [];

    foreach ($divisis as $divisi) {
        $chartLabels[] = $divisi->nama_divisi;
        
        if ($divisi->kapasitas > 0) {
            $persentase = round(($divisi->peserta_magangs_count / $divisi->kapasitas) * 100);
        } else {
            $persentase = 0;
        }
        
        $chartData[] = min($persentase, 100);
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
            'chartData',
            'selectedPeriode'
        )
    );
}
}