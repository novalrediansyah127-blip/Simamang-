@extends('layouts.admin')

@section('title', 'Riwayat Magang')

@section('styles')
<style>
    /* ================= PAGE HEADER ================= */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 22px;
    }

    .page-header h2 {
        margin: 0;
        font-size: 24px;
        color: #243b53;
    }

    .page-header p {
        margin: 7px 0 0;
        font-size: 14px;
        color: #829ab1;
    }

    /* ================= PDF BUTTON ================= */
    .btn-pdf {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 18px;
        background: #d93636;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
        transition: .2s;
    }

    .btn-pdf:hover {
        background: #bd2929;
        transform: translateY(-1px);
    }

    /* ================= STAT CARDS ================= */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .stat-card {
        background: white;
        border: 1px solid #e8eef4;
        border-radius: 9px;
        padding: 17px;
        min-height: 105px;
        box-shadow: 0 3px 10px rgba(31, 45, 61, .05);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .stat-label {
        font-size: 11px;
        color: #829ab1;
        margin-bottom: 7px;
    }

    .stat-value {
        font-size: 24px;
        font-weight: bold;
        color: #243b53;
    }

    .stat-value.blue { color: #1677e8; }
    .stat-value.green { color: #11955b; }
    .stat-value.purple { color: #7950d6; }

    /* ================= FILTER ================= */
    .filter-panel {
        background: white;
        border: 1px solid #e8eef4;
        border-radius: 9px;
        padding: 17px;
        margin-bottom: 20px;
        box-shadow: 0 3px 10px rgba(31, 45, 61, .05);
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        align-items: end;
    }

    .filter-group label {
        display: block;
        font-size: 11px;
        font-weight: bold;
        color: #66788a;
        margin-bottom: 6px;
    }

    .filter-control {
        width: 100%;
        height: 38px;
        border: 1px solid #d9e2ec;
        border-radius: 6px;
        padding: 0 10px;
        font-size: 13px;
        color: #243b53;
        background: white;
        box-sizing: border-box;
    }

    .filter-control:focus {
        outline: none;
        border-color: #1677e8;
        box-shadow: 0 0 0 3px rgba(22, 119, 232, .10);
    }

    /* ================= TABLE ================= */
    .table-panel {
        background: white;
        border: 1px solid #e8eef4;
        border-radius: 10px;
        padding: 22px;
        box-shadow: 0 3px 10px rgba(31, 45, 61, .05);
        overflow-x: auto;
    }

    .table-title {
        font-size: 17px;
        font-weight: bold;
        color: #243b53;
        margin-bottom: 18px;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1050px;
        font-size: 13px;
    }

    .data-table th {
        text-align: left;
        padding: 12px 10px;
        background: #f7f9fb;
        color: #66788a;
        font-size: 10px;
        text-transform: uppercase;
        border-bottom: 1px solid #e5ebf0;
        white-space: nowrap;
    }

    .data-table td {
        padding: 13px 10px;
        color: #52606d;
        border-bottom: 1px solid #edf1f5;
        vertical-align: middle;
    }

    .data-table tr:last-child td { border-bottom: none; }
    .data-table tr:hover td { background: #fafcff; }

    .number, .name {
        font-weight: bold;
        color: #243b53;
    }

    .division {
        display: inline-block;
        padding: 5px 9px;
        background: #e8f3ff;
        color: #1769aa;
        border-radius: 6px;
        font-size: 11px;
        font-weight: bold;
    }

    .status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: bold;
        background: #edf0f3;
        color: #66788a;
        white-space: nowrap;
    }

    /* ================= EMPTY & NO RESULT ================= */
    .empty {
        text-align: center;
        padding: 45px 20px !important;
        color: #829ab1 !important;
        font-size: 14px;
    }

    .empty-icon {
        font-size: 35px;
        margin-bottom: 10px;
    }

    .no-result {
        display: none;
        text-align: center;
        padding: 35px;
        color: #829ab1;
        font-size: 14px;
    }

    @media(max-width: 1100px) { .filter-grid { grid-template-columns: 1fr 1fr; } }
    @media(max-width: 1000px) { .stat-grid { grid-template-columns: repeat(2, 1fr); } }
    @media(max-width: 700px) {
        .page-header { flex-direction: column; gap: 15px; }
        .stat-grid, .filter-grid { grid-template-columns: 1fr; }
        .btn-pdf { width: 100%; justify-content: center; }
    }
</style>
@endsection

@section('content')

<!-- ================= HEADER ================= -->
<div class="page-header">
    <div>
        <h2>Riwayat Magang</h2>
        <p>Daftar peserta magang yang telah menyelesaikan masa magang</p>
    </div>

    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        <a href="{{ route('riwayat.exportPdf') }}" class="btn-pdf" id="btnExportPdf">
            📄 Export PDF
        </a>
        <a href="{{ route('riwayat.exportExcel') }}" class="btn-pdf" id="btnExportExcel" style="background: #11955b;">
            📊 Export Excel
        </a>
    </div>
</div>

<!-- ================= STATISTIK ================= -->
@php
    $hariIni = $riwayats->filter(function ($peserta) {
        return $peserta->tanggal_selesai && $peserta->tanggal_selesai->isToday();
    })->count();

    $bulanIni = $riwayats->filter(function ($peserta) {
        return $peserta->tanggal_selesai && $peserta->tanggal_selesai->isCurrentMonth();
    })->count();

    $totalRiwayat = $riwayats->count();
@endphp

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-label">Selesai Hari Ini</div>
        <div class="stat-value blue">{{ $hariIni }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Selesai Bulan Ini</div>
        <div class="stat-value green">{{ $bulanIni }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Riwayat</div>
        <div class="stat-value purple">{{ $totalRiwayat }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Status</div>
        <div class="stat-value green">Selesai</div>
    </div>
</div>

<!-- ================= FILTER ================= -->
<div class="filter-panel">
    <div class="filter-grid">
        <div class="filter-group">
            <label for="filterTanggalMulai">Tanggal Mulai</label>
            <input type="date" id="filterTanggalMulai" class="filter-control" value="{{ request('tanggal_mulai') }}">
        </div>

        <div class="filter-group">
            <label for="filterTanggal">Tanggal Selesai</label>
            <input type="date" id="filterTanggal" class="filter-control" value="{{ request('tanggal') }}">
        </div>

        <div class="filter-group">
            <label for="filterBulan">Filter Bulan</label>
            <select id="filterBulan" class="filter-control">
                <option value="">-- Semua Bulan --</option>
                @foreach($daftarBulan as $angkaBulan => $namaBulan)
                    <option value="{{ $angkaBulan }}" {{ request('bulan') == $angkaBulan ? 'selected' : '' }}>
                        {{ $namaBulan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="filterSearch">Cari Nama / Asal Sekolah / Jurusan / Divisi</label>
            <input type="text" id="filterSearch" class="filter-control" placeholder="Contoh: Andi, SMK Angkasa..." value="{{ request('search') }}">
        </div>

        <div class="filter-group">
            <label for="filterDivisi">Divisi</label>
            <select id="filterDivisi" class="filter-control">
                <option value="">-- Semua Divisi --</option>
                @foreach($divisis as $divisi)
                    <option value="{{ $divisi->id }}" {{ request('divisi') == $divisi->id ? 'selected' : '' }}>
                        {{ $divisi->kode_divisi }} - {{ $divisi->nama_divisi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="filterStatusJurnal">Status Jurnal</label>
            <select id="filterStatusJurnal" class="filter-control">
                <option value="">-- Semua Status --</option>
                <option value="selesai" {{ request('status_jurnal') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="belum" {{ request('status_jurnal') == 'belum' ? 'selected' : '' }}>Belum Selesai</option>
            </select>
        </div>
    </div>

    <div style="margin-top: 15px; display: flex; gap: 10px;">
        <button type="button" onclick="filterRiwayat()" style="background-color: #1677e8; border: none; border-radius: 8px; padding: 8px 20px; font-weight: 700; font-size: 14px; color: #ffffff; cursor: pointer;">
            🔍 Cari
        </button>
        <button type="button" onclick="resetFilter()" style="background-color: #e2e8f0; border: none; border-radius: 8px; padding: 8px 20px; font-weight: 700; font-size: 14px; color: #334155; cursor: pointer;">
            Reset
        </button>
    </div>
</div>

<!-- ================= TABLE ================= -->
<div class="table-panel">
    <div class="table-title">Daftar Riwayat Peserta Magang</div>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peserta</th>
                <th>Asal Sekolah/Universitas</th>
                <th>Jurusan</th>
                <th>Divisi</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Status Magang</th>
                <th>Status Jurnal</th>
                <th>Nilai</th>
            </tr>
        </thead>

        <tbody id="riwayatTableBody">
            @forelse($riwayats as $index => $peserta)
                @php
                    $namaDivisi = $peserta->divisi ? $peserta->divisi->nama_divisi : '';
                    $kodeDivisi = $peserta->divisi ? $peserta->divisi->kode_divisi : '';
                    $statusJurnal = $peserta->jurnal ? 'selesai' : 'belum';
                    $statusJurnalText = $peserta->jurnal ? 'sudah dikumpulkan selesai' : 'belum selesai';
                @endphp

                <tr class="riwayat-row"
                    data-tanggal-mulai="{{ $peserta->tanggal_mulai ? $peserta->tanggal_mulai->format('Y-m-d') : '' }}"
                    data-tanggal="{{ $peserta->tanggal_selesai ? $peserta->tanggal_selesai->format('Y-m-d') : '' }}"
                    data-search="{{ strtolower($peserta->nama . ' ' . $peserta->asal_instansi . ' ' . $peserta->jurusan . ' ' . $namaDivisi . ' ' . $kodeDivisi . ' ' . $statusJurnalText) }}"
                    data-divisi="{{ $peserta->divisi_id ?? '' }}"
                    data-status-jurnal="{{ $statusJurnal }}"
                >
                    <td class="number">{{ $index + 1 }}</td>
                    <td class="name">{{ $peserta->nama }}</td>
                    <td>{{ $peserta->asal_instansi }}</td>
                    <td>{{ $peserta->jurusan }}</td>
                    <td><span class="division">{{ $namaDivisi ?: '-' }}</span></td>
                    <td>{{ $peserta->tanggal_mulai ? $peserta->tanggal_mulai->format('d/m/Y') : '-' }}</td>
                    <td>{{ $peserta->tanggal_selesai ? $peserta->tanggal_selesai->format('d/m/Y') : '-' }}</td>
                    <td><span class="status">Selesai</span></td>
                    <td>
                        @if($peserta->jurnal)
                            <span class="status" style="background:#e4f7ed; color:#11955b;">✓ Sudah Dikumpulkan</span>
                        @else
                            <span class="status" style="background:#ffe7e7; color:#d93636;">Belum Selesai</span>
                        @endif
                    </td>
                    <td>
                        @if($peserta->jurnal && $peserta->jurnal->nilai !== null)
                            <strong style="color:#1677e8;">{{ $peserta->jurnal->nilai }}</strong>
                        @else
                            <span style="color:#9aa8b5;">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="empty">
                        <div class="empty-icon">📁</div>
                        Belum ada peserta yang menyelesaikan masa magang.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div id="noResult" class="no-result">
        🔍 Tidak ditemukan data yang sesuai dengan pencarian.
    </div>
</div>

<!-- ================= SCRIPT FILTER TERPERBAIKI ================= -->
<script>
let isFiltering = false;

function updateExportButtons() {
    const tanggalMulai = document.getElementById('filterTanggalMulai')?.value || '';
    const tanggal = document.getElementById('filterTanggal')?.value || '';
    const search = document.getElementById('filterSearch')?.value || '';
    const divisi = document.getElementById('filterDivisi')?.value || '';
    const statusJurnal = document.getElementById('filterStatusJurnal')?.value || '';

    const pdfUrl = new URL("{{ route('riwayat.exportPdf') }}", window.location.origin);
    if (tanggalMulai) pdfUrl.searchParams.set('tanggal_mulai', tanggalMulai);
    if (tanggal) pdfUrl.searchParams.set('tanggal', tanggal);
    if (search) pdfUrl.searchParams.set('search', search);
    if (divisi) pdfUrl.searchParams.set('divisi', divisi);
    if (statusJurnal) pdfUrl.searchParams.set('status_jurnal', statusJurnal);

    const buttonPdf = document.getElementById('btnExportPdf');
    if (buttonPdf) buttonPdf.href = pdfUrl.toString();

    const excelUrl = new URL("{{ route('riwayat.exportExcel') }}", window.location.origin);
    if (tanggalMulai) excelUrl.searchParams.set('tanggal_mulai', tanggalMulai);
    if (tanggal) excelUrl.searchParams.set('tanggal', tanggal);
    if (search) excelUrl.searchParams.set('search', search);
    if (divisi) excelUrl.searchParams.set('divisi', divisi);
    if (statusJurnal) excelUrl.searchParams.set('status_jurnal', statusJurnal);

    const buttonExcel = document.getElementById('btnExportExcel');
    if (buttonExcel) buttonExcel.href = excelUrl.toString();
}

function filterRiwayat() {
    if (isFiltering) return;
    isFiltering = true;

    const tanggalMulai = document.getElementById('filterTanggalMulai')?.value.trim() || '';
    const tanggal = document.getElementById('filterTanggal')?.value.trim() || '';
    const bulan = document.getElementById('filterBulan')?.value.trim() || '';
    const search = document.getElementById('filterSearch')?.value.trim().toLowerCase() || '';
    const divisi = document.getElementById('filterDivisi')?.value.trim() || '';
    const status = document.getElementById('filterStatusJurnal')?.value.trim().toLowerCase() || '';

    const rows = document.querySelectorAll('.riwayat-row');
    let ditemukan = 0;

    rows.forEach(function(row) {
        const rowTanggalMulai = (row.dataset.tanggalMulai || '').trim();
        const rowTanggal = (row.dataset.tanggal || '').trim();
        const rowSearch = (row.dataset.search || '').toLowerCase();
        const rowDivisi = (row.dataset.divisi || '').trim();
        const rowStatus = (row.dataset.statusJurnal || '').toLowerCase();

        const cocokTanggalMulai = tanggalMulai === '' || rowTanggalMulai === tanggalMulai;
        const cocokTanggal = tanggal === '' || rowTanggal === tanggal;

        let cocokBulan = true;
        if (bulan !== '') {
            const padBulan = bulan.padStart(2, '0');
            const bulanMulai = rowTanggalMulai ? rowTanggalMulai.split('-')[1] : '';
            const bulanSelesai = rowTanggal ? rowTanggal.split('-')[1] : '';
            cocokBulan = (bulanMulai === padBulan || bulanSelesai === padBulan);
        }

        const cocokSearch = search === '' || rowSearch.includes(search);
        const cocokDivisi = divisi === '' || rowDivisi === divisi;
        const cocokStatus = status === '' || rowStatus === status;

        if (cocokTanggalMulai && cocokTanggal && cocokBulan && cocokSearch && cocokDivisi && cocokStatus) {
            row.style.display = '';
            ditemukan++;
        } else {
            row.style.display = 'none';
        }
    });

    const noResult = document.getElementById('noResult');
    if (noResult) {
        noResult.style.display = ditemukan === 0 ? 'block' : 'none';
    }

    updateExportButtons();
    isFiltering = false;
}

function resetFilter() {
    const ids = ['filterTanggalMulai', 'filterTanggal', 'filterBulan', 'filterSearch', 'filterDivisi', 'filterStatusJurnal'];
    ids.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = '';
    });

    document.querySelectorAll('.riwayat-row').forEach(row => row.style.display = '');

    const noResult = document.getElementById('noResult');
    if (noResult) noResult.style.display = 'none';

    updateExportButtons();
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('filterSearch');
    if (searchInput) {
        searchInput.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                filterRiwayat();
            }
        });
    }
    updateExportButtons();
});
</script>
@endsection