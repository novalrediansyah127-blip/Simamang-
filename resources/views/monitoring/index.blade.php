@extends('layouts.admin')

@section('title', 'Monitoring Kuota')

@section('page-title')

@section('styles')
<style>

    /* =========================
       HEADER
    ========================= */

    .monitor-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 25px;
    }

    .monitor-header h2 {
        margin: 0;
        font-size: 28px;
        color: #142b4a;
    }

    .monitor-header p {
        margin: 7px 0 0;
        color: #7890aa;
        font-size: 14px;
    }


    /* =========================
       STAT CARDS
    ========================= */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: white;
        border: 1px solid #e5edf5;
        border-radius: 12px;
        padding: 22px;
        display: flex;
        align-items: center;
        gap: 17px;
        box-shadow: 0 4px 15px rgba(31, 45, 61, .06);
    }

    .stat-icon {
        width: 58px;
        height: 58px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        flex-shrink: 0;
    }

    .icon-blue {
        background: #e6f1ff;
    }

    .icon-purple {
        background: #f0e8ff;
    }

    .icon-green {
        background: #e4f8ed;
    }

    .icon-orange {
        background: #fff1dc;
    }

    .stat-label {
        font-size: 12px;
        color: #71869d;
        font-weight: bold;
        text-transform: uppercase;
    }

    .stat-number {
        font-size: 29px;
        font-weight: bold;
        color: #142b4a;
        margin-top: 3px;
    }

    .stat-desc {
        font-size: 12px;
        color: #8a9bad;
        margin-top: 2px;
    }


    /* =========================
       MAIN CONTENT
    ========================= */

    .monitor-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 20px;
        align-items: stretch;
    }

    .panel {
        background: white;
        border: 1px solid #e5edf5;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(31, 45, 61, .06);
        overflow: hidden;
    }

    .panel-header {
        padding: 20px 22px;
        border-bottom: 1px solid #edf1f5;
    }

    .panel-header h3 {
        margin: 0;
        font-size: 18px;
        color: #142b4a;
    }

    .panel-header p {
        margin: 5px 0 0;
        font-size: 13px;
        color: #829ab1;
    }


    /* =========================
       TABLE
    ========================= */

    .table-wrap {
        overflow-x: auto;
    }

    .monitor-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .monitor-table th {
        padding: 13px 14px;
        background: #f7f9fb;
        color: #66788a;
        font-size: 11px;
        text-transform: uppercase;
        text-align: left;
        border-bottom: 1px solid #e5ebf0;
    }

    .monitor-table td {
        padding: 16px 14px;
        border-bottom: 1px solid #edf1f5;
        color: #52606d;
    }

    .monitor-table tr:last-child td {
        border-bottom: none;
    }

    .monitor-table tr:hover td {
        background: #fafcff;
    }

    .division-name {
        font-weight: bold;
        color: #243b53;
    }

    .capacity {
        font-weight: bold;
        color: #243b53;
    }

    .used {
        font-weight: bold;
        color: #1677e8;
    }

    .remaining {
        font-weight: bold;
        color: #14945b;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
    }

    .status-ready {
        background: #e3f7ec;
        color: #118b55;
    }

    .status-full {
        background: #ffe5e5;
        color: #d93636;
    }

    .btn-view {
        display: inline-block;
        padding: 7px 12px;
        border: 1px solid #1677e8;
        color: #1677e8;
        background: white;
        border-radius: 6px;
        text-decoration: none;
        font-size: 11px;
        font-weight: bold;
        transition: .2s;
    }

    .btn-view:hover {
        background: #1677e8;
        color: white;
    }


    /* =========================
       CHART
    ========================= */

    .chart-panel {
        padding-bottom: 20px;
    }

    .chart-container {
        padding: 20px 22px;
    }

    .chart-title {
        font-size: 12px;
        color: #71869d;
        margin-bottom: 20px;
    }

    .chart-area {
        height: 300px;
        display: flex;
        align-items: flex-end;
        justify-content: space-around;
        gap: 15px;
        border-bottom: 1px solid #9aaabd;
        padding: 0 10px;
    }

    .chart-item {
        height: 100%;
        flex: 1;
        max-width: 75px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
    }

    .chart-value {
        font-size: 13px;
        font-weight: bold;
        color: #142b4a;
        margin-bottom: 7px;
    }

    .chart-bar {
        width: 48px;
        border-radius: 7px 7px 0 0;
        min-height: 8px;
        transition: .3s;
    }

    .chart-bar:hover {
        opacity: .8;
        transform: scaleY(1.02);
        transform-origin: bottom;
    }

    .bar-1 {
        background: #1677e8;
    }

    .bar-2 {
        background: #e94b4b;
    }

    .bar-3 {
        background: #f5b323;
    }

    .bar-4 {
        background: #20a36a;
    }

    .bar-5 {
        background: #7b43c6;
    }

    .chart-name {
        margin-top: 10px;
        text-align: center;
        font-size: 10px;
        color: #52606d;
        line-height: 1.3;
    }


    /* =========================
       CHART LEGEND
    ========================= */

    .chart-list {
        margin-top: 20px;
    }

    .chart-list-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 0;
        font-size: 12px;
        color: #52606d;
    }

    .chart-left {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .chart-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .dot-1 {
        background: #1677e8;
    }

    .dot-2 {
        background: #e94b4b;
    }

    .dot-3 {
        background: #f5b323;
    }

    .dot-4 {
        background: #20a36a;
    }

    .dot-5 {
        background: #7b43c6;
    }

    .percentage {
        font-weight: bold;
        color: #142b4a;
    }


    /* =========================
       TOTAL FOOTER
    ========================= */

    .total-box {
        margin-top: 18px;
        padding: 16px;
        background: #f4f8ff;
        border: 1px solid #d9e7fa;
        border-radius: 9px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        text-align: center;
    }

    .total-label {
        font-size: 11px;
        color: #71869d;
        margin-bottom: 5px;
    }

    .total-value {
        font-size: 18px;
        font-weight: bold;
        color: #1677e8;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1100px) {

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .monitor-grid {
            grid-template-columns: 1fr;
        }

    }

    @media (max-width: 600px) {

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .total-box {
            grid-template-columns: 1fr;
            gap: 15px;
        }

    }

</style>
@endsection


@section('content')

<!-- =========================
     HEADER
========================= -->

<div class="monitor-header">

    <div>

        <h2>Monitoring Kuota</h2>

        <p>
            Pantau kuota dan peserta magang di setiap divisi.
        </p>

    </div>

</div>


<!-- =========================
     STATISTICS
========================= -->

<div class="stats-grid">

    <div class="stat-card">

        <div class="stat-icon icon-blue">
            🏢
        </div>

        <div>

            <div class="stat-label">
                Total Divisi
            </div>

            <div class="stat-number">
                {{ $totalDivisi }}
            </div>

            <div class="stat-desc">
                Divisi
            </div>

        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon icon-purple">
            👥
        </div>

        <div>

            <div class="stat-label">
                Peserta Aktif
            </div>

            <div class="stat-number">
                {{ $totalPeserta }}
            </div>

            <div class="stat-desc">
                Peserta
            </div>

        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon icon-green">
            ✓
        </div>

        <div>

            <div class="stat-label">
                Sisa Kuota Keseluruhan
            </div>

            <div class="stat-number">
                {{ $sisaKuota }}
            </div>

            <div class="stat-desc">
                Slot tersedia
            </div>

        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon icon-orange">
            📊
        </div>

        <div>

            <div class="stat-label">
                Total Kapasitas
            </div>

            <div class="stat-number">
                {{ $totalKapasitas }}
            </div>

            <div class="stat-desc">
                Kapasitas keseluruhan
            </div>

        </div>

    </div>

</div>


<!-- =========================
     TABLE + CHART
========================= -->

<div class="monitor-grid">


    <!-- =====================
         TABLE
    ====================== -->

    <div class="panel">

        <div class="panel-header">

            <h3>
                Ringkasan Kuota Tiap Divisi
            </h3>

            <p>
                Informasi kapasitas peserta pada setiap divisi.
            </p>

        </div>


        <div class="table-wrap">

            <table class="monitor-table">

                <thead>

                    <tr>

                        <th>Divisi</th>

                        <th>Kapasitas</th>

                        <th>Terpakai</th>

                        <th>Sisa</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($divisis as $divisi)

                        @php

                            $terpakai = $divisi->pesertas
                                ->where('status', 'Aktif')
                                ->count();

                            $sisa = max(
                                $divisi->kapasitas - $terpakai,
                                0
                            );

                        @endphp


                        <tr>

                            <td>

                                <span class="division-name">
                                    {{ $divisi->nama_divisi }}
                                </span>

                            </td>


                            <td>

                                <span class="capacity">
                                    {{ $divisi->kapasitas }}
                                </span>

                            </td>


                            <td>

                                <span class="used">
                                    {{ $terpakai }}
                                </span>

                            </td>


                            <td>

                                <span class="remaining">
                                    {{ $sisa }}
                                </span>

                            </td>


                            <td>

                                @if($sisa > 0)

                                    <span class="status-badge status-ready">
                                        Tersedia
                                    </span>

                                @else

                                    <span class="status-badge status-full">
                                        Penuh
                                    </span>

                                @endif

                            </td>


                            <td>

                                <a
                                    href="{{ route('monitoring.show', $divisi->id) }}"
                                    class="btn-view"
                                >
                                    Lihat Peserta →
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>



    <!-- =====================
         CHART
    ====================== -->

    <div class="panel chart-panel">

        <div class="panel-header">

            <h3>
                Kuota Terpakai per Divisi
            </h3>

            <p>
                Persentase peserta aktif berdasarkan kapasitas.
            </p>

        </div>


        <div class="chart-container">

            <div class="chart-title">
                Persentase (%)
            </div>


            <div class="chart-area">

                @foreach($divisis as $index => $divisi)

                    @php

                        $terpakai = $divisi->pesertas
                            ->where('status', 'Aktif')
                            ->count();

                        $persentase = $divisi->kapasitas > 0
                            ? round(($terpakai / $divisi->kapasitas) * 100)
                            : 0;

                    @endphp


                    <div class="chart-item">

                        <div class="chart-value">
                            {{ $persentase }}%
                        </div>

                        <div
                            class="chart-bar bar-{{ ($index % 5) + 1 }}"
                            style="height: {{ max($persentase, 3) }}%;"
                        >
                        </div>

                        <div class="chart-name">

                            {{ $divisi->nama_divisi }}

                        </div>

                    </div>

                @endforeach

            </div>


@endsection