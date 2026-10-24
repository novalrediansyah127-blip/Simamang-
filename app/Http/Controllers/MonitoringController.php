<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\PesertaMagang;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil input periode (format: YYYY-MM dari <input type="month">)
        $selectedPeriode = $request->input('periode', date('Y-m'));
        
        // Pecah menjadi tahun dan bulan
        $pecahPeriode = explode('-', $selectedPeriode);
        $selectedTahun = $pecahPeriode[0] ?? date('Y');
        $selectedBulan = $pecahPeriode[1] ?? date('m');

        // 2. Hitung jumlah peserta terisi per divisi BERDASARKAN PERIODE yang dipilih
        $divisis = Divisi::withCount([
            'pesertas as peserta_magangs_count' => function ($query) use ($selectedBulan, $selectedTahun) {
                $query->where('status', '!=', 'Selesai')
                      ->whereYear('tanggal_mulai', '<=', $selectedTahun)
                      ->whereMonth('tanggal_mulai', '<=', $selectedBulan)
                      ->whereYear('tanggal_selesai', '>=', $selectedTahun)
                      ->whereMonth('tanggal_selesai', '>=', $selectedBulan);
            }
        ])->get();

        // 3. Hitung statistik keseluruhan sesuai periode
        $totalDivisi = $divisis->count();
        $totalKapasitas = $divisis->sum('kapasitas');
        $totalTerisi = $divisis->sum('peserta_magangs_count');
        
        // Total peserta aktif pada periode tersebut
        $totalPeserta = $totalTerisi; 
        
        // Sisa kuota keseluruhan
        $sisaKuota = max($totalKapasitas - $totalTerisi, 0);

        // 4. Hitung data untuk Grafik / Chart persentase per divisi
        $chartLabels = [];
        $chartData = [];

        foreach ($divisis as $divisi) {
            $chartLabels[] = $divisi->nama_divisi;
            $persentase = $divisi->kapasitas > 0 
                ? round(($divisi->peserta_magangs_count / $divisi->kapasitas) * 100) 
                : 0;
            $chartData[] = min($persentase, 100);
        }

        return view('monitoring.index', compact(
            'divisis',
            'totalDivisi',
            'totalKapasitas',
            'totalTerisi',
            'totalPeserta',
            'sisaKuota',
            'chartLabels',
            'chartData',
            'selectedPeriode'
        ));
    }

    public function show($id, Request $request)
    {
        // 1. Ambil periode dari request (jika kosong, gunakan bulan & tahun saat ini)
        $selectedPeriode = $request->input('periode', date('Y-m'));
        $pecahPeriode = explode('-', $selectedPeriode);
        $selectedTahun = $pecahPeriode[0] ?? date('Y');
        $selectedBulan = $pecahPeriode[1] ?? date('m');

        // 2. Ambil data divisi dan filter peserta HANYA yang aktif di bulan & tahun tersebut
        $divisi = Divisi::with([
            'pesertas' => function ($query) use ($selectedBulan, $selectedTahun) {
                $query->where('status', '!=', 'Selesai')
                      ->whereYear('tanggal_mulai', '<=', $selectedTahun)
                      ->whereMonth('tanggal_mulai', '<=', $selectedBulan)
                      ->whereYear('tanggal_selesai', '>=', $selectedTahun)
                      ->whereMonth('tanggal_selesai', '>=', $selectedBulan)
                      ->orderBy('tanggal_mulai', 'asc');
            }
        ])->findOrFail($id);

        // 3. Hitung jumlah peserta aktif dan sisa kuota khusus untuk periode ini
        $pesertaAktifCount = $divisi->pesertas->count();
        $sisaKuota = max($divisi->kapasitas - $pesertaAktifCount, 0);

        return view('monitoring.show', compact('divisi', 'selectedPeriode', 'pesertaAktifCount', 'sisaKuota'));
    }
}