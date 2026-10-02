<?php

namespace App\Http\Controllers;

use App\Models\PesertaMagang;
use App\Models\Divisi;
use App\Exports\RiwayatMagangExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RiwayatMagangController extends Controller
{
    // ======================================================
    // RIWAYAT MAGANG
    // ======================================================

    public function index(Request $request)
    {
        $query = PesertaMagang::with(['divisi', 'jurnal'])
            ->where('status', 'Selesai');

       // Filter Tanggal Mulai
    if ($request->filled('tanggal_mulai')) {
        // Menggunakan whereDate agar jam/menit/detik dihiraukan
        $query->whereDate('tanggal_mulai', '>=', $request->tanggal_mulai);
    }

        // ==========================
        // FILTER TANGGAL SELESAI
        // ==========================
        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal_selesai','<=', $request->tanggal_selesai);
        }

        // ==========================
        // FILTER BULAN (DARI TEXT DROPDOWN JANUARI - DESEMBER)
        // ==========================
        if ($request->filled('bulan')) {
            $query->where(function ($q) use ($request) {
                $q->whereMonth('tanggal_mulai', $request->bulan)
                  ->orWhereMonth('tanggal_selesai', $request->bulan);
            });
        }

        // ==========================
        // FILTER SEARCH (NAMA / INSTANSI / JURUSAN / DIVISI)
        // ==========================
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('asal_instansi', 'like', '%' . $search . '%')
                  ->orWhere('jurusan', 'like', '%' . $search . '%')
                  ->orWhereHas('divisi', function ($divisi) use ($search) {
                      $divisi->where('nama_divisi', 'like', '%' . $search . '%')
                             ->orWhere('kode_divisi', 'like', '%' . $search . '%');
                  });
            });
        }

        // ==========================
        // FILTER DIVISI
        // ==========================
        if ($request->filled('divisi')) {
            $query->where('divisi_id', $request->divisi);
        }

        // ==========================
        // FILTER STATUS JURNAL
        // ==========================
        if ($request->filled('status_jurnal')) {
            if ($request->status_jurnal === 'selesai') {
                $query->whereHas('jurnal');
            } elseif ($request->status_jurnal === 'belum') {
                $query->whereDoesntHave('jurnal');
            }
        }

        // AMBIL DATA HASIL FILTER
        $riwayats = $query->orderBy('tanggal_selesai', 'desc')->get();
        $divisis  = Divisi::orderBy('nama_divisi')->get();

        // ARRAY NAMA BULAN UNTUK DROPDOWN
        $daftarBulan = [
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return view('riwayat.index', compact('riwayats', 'divisis', 'daftarBulan'));
    }


    // ======================================================
    // EXPORT PDF
    // ======================================================

    public function exportPdf(Request $request)
    {
        $query = PesertaMagang::with(['divisi', 'jurnal'])
            ->where('status', 'Selesai');

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal_mulai', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal_selesai', $request->tanggal_selesai);
        }

        if ($request->filled('bulan')) {
            $query->where(function ($q) use ($request) {
                $q->whereMonth('tanggal_mulai', $request->bulan)
                  ->orWhereMonth('tanggal_selesai', $request->bulan);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('asal_instansi', 'like', '%' . $search . '%')
                  ->orWhere('jurusan', 'like', '%' . $search . '%')
                  ->orWhereHas('divisi', function ($divisi) use ($search) {
                      $divisi->where('nama_divisi', 'like', '%' . $search . '%')
                             ->orWhere('kode_divisi', 'like', '%' . $search . '%');
                  });
            });
        }

        if ($request->filled('divisi')) {
            $query->where('divisi_id', $request->divisi);
        }

        if ($request->filled('status_jurnal')) {
            if ($request->status_jurnal === 'selesai') {
                $query->whereHas('jurnal');
            } elseif ($request->status_jurnal === 'belum') {
                $query->whereDoesntHave('jurnal');
            }
        }

        $riwayats = $query->orderBy('tanggal_selesai', 'desc')->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'riwayat.pdf',
            compact('riwayats')
        );

        return $pdf->download('riwayat-magang.pdf');
    }


    // ======================================================
    // EXPORT EXCEL
    // ======================================================

    public function exportExcel(Request $request)
    {
        $filters = [
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'bulan'           => $request->bulan,
            'search'          => $request->search,
            'divisi'          => $request->divisi,
            'status_jurnal'   => $request->status_jurnal,
        ];

        return Excel::download(
            new RiwayatMagangExport($filters),
            'riwayat-magang.xlsx'
        );
    }
}