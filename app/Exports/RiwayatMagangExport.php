<?php

namespace App\Exports;

use App\Models\PesertaMagang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RiwayatMagangExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }


    // ======================================================
    // DATA YANG AKAN DIEKSPOR
    // ======================================================

    public function collection()
    {
        $query = PesertaMagang::with([
            'divisi',
            'jurnal'
        ])
        ->where('status', 'Selesai');


        // ==================================================
        // FILTER TANGGAL
        // ==================================================

        if (!empty($this->filters['tanggal'])) {

            $query->whereDate(
                'tanggal_selesai',
                $this->filters['tanggal']
            );
        }


        // ==================================================
        // FILTER PENCARIAN
        // ==================================================

        if (!empty($this->filters['search'])) {

            $search = $this->filters['search'];

            $query->where(function ($q) use ($search) {

                $q->where(
                    'nama',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'asal_instansi',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'jurusan',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhereHas('divisi', function ($divisi) use ($search) {

                    $divisi
                        ->where(
                            'nama_divisi',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'kode_divisi',
                            'like',
                            '%' . $search . '%'
                        );
                });
            });
        }


        // ==================================================
        // FILTER DIVISI
        // ==================================================

        if (!empty($this->filters['divisi'])) {

            $query->where(
                'divisi_id',
                $this->filters['divisi']
            );
        }


        // ==================================================
        // FILTER STATUS JURNAL
        // ==================================================

        if (!empty($this->filters['status_jurnal'])) {

            if ($this->filters['status_jurnal'] === 'selesai') {

                $query->whereHas('jurnal');

            } elseif ($this->filters['status_jurnal'] === 'belum') {

                $query->whereDoesntHave('jurnal');
            }
        }


        // ==================================================
        // AMBIL DAN FORMAT DATA
        // ==================================================

        return $query
            ->orderBy('tanggal_selesai', 'desc')
            ->get()
            ->map(function ($peserta) {

                return [

                    'Nama Peserta' =>
                        $peserta->nama,

                    'Asal Sekolah/Universitas' =>
                        $peserta->asal_instansi,

                    'Jurusan' =>
                        $peserta->jurusan,

                    'Divisi' =>
                        $peserta->divisi
                            ? $peserta->divisi->nama_divisi
                            : '-',

                    'Tanggal Mulai' =>
                        $peserta->tanggal_mulai
                            ? $peserta->tanggal_mulai->format('d/m/Y')
                            : '-',

                    'Tanggal Selesai' =>
                        $peserta->tanggal_selesai
                            ? $peserta->tanggal_selesai->format('d/m/Y')
                            : '-',

                    'Status Magang' =>
                        'Selesai',

                    'Status Jurnal' =>
                        $peserta->jurnal
                            ? 'Sudah Dikumpulkan'
                            : 'Belum Selesai',

                    'Nilai' =>
                        $peserta->jurnal &&
                        $peserta->jurnal->nilai !== null
                            ? $peserta->jurnal->nilai
                            : '-',
                ];
            });
    }


    // ======================================================
    // JUDUL KOLOM EXCEL
    // ======================================================

    public function headings(): array
    {
        return [

            'Nama Peserta',
            'Asal Sekolah/Universitas',
            'Jurusan',
            'Divisi',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Status Magang',
            'Status Jurnal',
            'Nilai',

        ];
    }
}