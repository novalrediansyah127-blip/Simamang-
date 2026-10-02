@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')


@section('styles')

<style>

    /* ================= WELCOME ================= */

    .welcome {
        margin-bottom: 25px;
    }

    .welcome h2 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        color: #243b53;
    }

    .welcome p {
        margin: 8px 0 0;
        font-size: 14px;
        color: #829ab1;
    }


    /* ================= STAT CARDS ================= */

    .stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: white;

        border: 1px solid #e8eef4;
        border-radius: 10px;

        padding: 20px;

        display: flex;
        align-items: center;
        gap: 16px;

        min-height: 115px;

        box-shadow:
            0 3px 10px rgba(31, 45, 61, .05);
    }

    .stat-icon {
        width: 55px;
        height: 55px;

        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 25px;

        flex-shrink: 0;
    }

    .icon-blue {
        background: #e8f3ff;
        color: #1677e8;
    }

    .icon-purple {
        background: #f1e9ff;
        color: #7c3aed;
    }

    .icon-green {
        background: #e6f8ef;
        color: #16a05d;
    }

    .icon-orange {
        background: #fff3df;
        color: #ef9b20;
    }

    .stat-label {
        font-size: 11px;

        text-transform: uppercase;

        color: #8795a1;

        font-weight: bold;

        margin-bottom: 5px;
    }

    .stat-number {
        font-size: 32px;

        line-height: 1.1;

        font-weight: bold;

        color: #243b53;
    }

    .stat-desc {
        font-size: 12px;

        color: #9aa8b5;

        margin-top: 3px;
    }


    /* ================= LOWER CONTENT ================= */

    .dashboard-grid {
        display: grid;

        grid-template-columns:
            1.45fr
            1fr;

        gap: 22px;
    }


    .panel {
        background: white;

        border: 1px solid #e8eef4;

        border-radius: 10px;

        padding: 22px;

        min-height: 350px;

        box-shadow:
            0 3px 10px rgba(31, 45, 61, .05);
    }


    .panel-header {
        display: flex;

        justify-content: space-between;

        align-items: center;

        margin-bottom: 18px;
    }


    .panel-title {
        font-size: 17px;

        font-weight: bold;

        color: #243b53;
    }


    /* ================= TABLE ================= */

    table {
        width: 100%;

        border-collapse: collapse;

        font-size: 14px;
    }

    th {
        text-align: left;

        padding: 12px 10px;

        background: #f7f9fb;

        color: #66788a;

        font-size: 11px;

        text-transform: uppercase;

        font-weight: bold;
    }

    td {
        padding: 14px 10px;

        border-bottom: 1px solid #edf1f5;

        color: #52606d;

        font-size: 14px;
    }

    tr:last-child td {
        border-bottom: none;
    }


    /* ================= STATUS ================= */

    .status {
        display: inline-block;

        padding: 6px 11px;

        border-radius: 20px;

        font-size: 11px;

        font-weight: bold;
    }

    .status-green {
        background: #e4f7ed;
        color: #11955b;
    }

    .status-red {
        background: #ffe7e7;
        color: #d93636;
    }

    .status-yellow {
        background: #fff2d7;
        color: #d89100;
    }


    /* ================= DONUT ================= */

    .chart-area {
        display: flex;

        align-items: center;

        justify-content: center;

        gap: 35px;

        min-height: 270px;
    }


    .donut {
    width: 205px;
    height: 205px;

    border-radius: 50%;

    position: relative;

    flex-shrink: 0;

    background: var(--donut-gradient);
}

/* Lubang tengah donut */
.donut::after {
    content: "";

    position: absolute;

    width: 115px;
    height: 115px;

    background: white;

    border-radius: 50%;

    top: 45px;
    left: 45px;
}

/* Angka persentase di tengah */
.donut-center {
    position: absolute;

    top: 50%;
    left: 50%;

    transform: translate(-50%, -50%);

    z-index: 2;

    text-align: center;

    color: #243b53;
}

.donut-center-number {
    font-size: 25px;
    font-weight: bold;
}

.donut-center-text {
    font-size: 10px;
    color: #829ab1;
    margin-top: 2px;
}

    .donut::after {
        content: "";

        position: absolute;

        width: 115px;
        height: 115px;

        background: white;

        border-radius: 50%;

        top: 45px;
        left: 45px;
    }


    .legend {
        display: flex;

        flex-direction: column;

        gap: 13px;
    }


    .legend-item {
        display: flex;

        align-items: center;

        gap: 9px;

        font-size: 13px;

        color: #52606d;
    }


    .legend-dot {
        width: 11px;
        height: 11px;

        border-radius: 50%;

        flex-shrink: 0;
    }


    .blue {
        background: #2785dc;
    }

    .red {
        background: #ef5350;
    }

    .yellow {
        background: #fbbd24;
    }

    .green {
        background: #22a06b;
    }

    .purple {
        background: #8147c7;
    }


    /* ================= RESPONSIVE ================= */

    @media(max-width: 1100px) {

        .stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

    }


    @media(max-width: 600px) {

        .stats {
            grid-template-columns: 1fr;
        }

        .welcome h2 {
            font-size: 23px;
        }

        .chart-area {
            flex-direction: column;
        }

    }

</style>

@endsection


@section('content')


<!-- WELCOME -->

<div class="welcome">

    <h2>

        Selamat datang, {{ Auth::user()->name }}! 👋

    </h2>

    <p>

        Berikut ringkasan informasi sistem SIMAMANG.

    </p>

</div>



<!-- STATISTICS -->

<div class="stats">


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
                Total Peserta Aktif
            </div>

            <div class="stat-number">
                {{ $totalPesertaAktif ?? 0 }}
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
                Total Peserta Selesai
            </div>

            <div class="stat-number">
                {{ $totalPesertaSelesai ?? 0 }}
            </div>

            <div class="stat-desc">
                Peserta
            </div>

        </div>

    </div>



    <div class="stat-card">

        <div class="stat-icon icon-orange">

            📊

        </div>

        <div>

            <div class="stat-label">
                Sisa Kuota Keseluruhan
            </div>

            <div class="stat-number">
                {{ $sisaKuota ?? 0 }}
            </div>

            <div class="stat-desc">
                Slot tersedia
            </div>

        </div>

    </div>


</div>



<!-- LOWER CONTENT -->

<div class="dashboard-grid">


    <!-- TABLE -->

    <div class="panel">

        <div class="panel-header">

            <div class="panel-title">

                Ringkasan Kuota Tiap Divisi

            </div>

        </div>


        <table>

            <thead>

                <tr>

                    <th>Divisi</th>

                    <th>Terisi</th>

                    <th>Kapasitas</th>

                    <th>Sisa</th>

                    <th>Status</th>

                </tr>

            </thead>


            <tbody>

                @forelse($divisis as $divisi)

                    @php

                        $terisi = $divisi->peserta_magangs_count ?? 0;

                        $sisa = max(
                            $divisi->kapasitas - $terisi,
                            0
                        );

                        $persentase = $divisi->kapasitas > 0
                            ? ($terisi / $divisi->kapasitas) * 100
                            : 0;

                    @endphp


                    <tr>

                        <td>
                            {{ $divisi->nama_divisi }}
                        </td>

                        <td>
                            {{ $terisi }}
                        </td>

                        <td>
                            {{ $divisi->kapasitas }}
                        </td>

                        <td>

                            <strong
                                style="
                                    color:
                                    {{ $sisa > 0
                                        ? '#16a05d'
                                        : '#d93636' }};
                                "
                            >

                                {{ $sisa }}

                            </strong>

                        </td>

                        <td>

                            @if($sisa == 0)

                                <span class="status status-red">
                                    Penuh
                                </span>

                            @elseif($persentase >= 80)

                                <span class="status status-yellow">
                                    Hampir Penuh
                                </span>

                            @else

                                <span class="status status-green">
                                    Tersedia
                                </span>

                            @endif

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td
                            colspan="5"
                            style="text-align:center;"
                        >

                            Belum ada data divisi.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>



    <!-- DONUT (MENGGUNAKAN BLADE CSS DINAMIS) -->
    <div class="panel">
        <div class="panel-header">
            <div class="panel-title">
                Persentase Kuota Terisi
            </div>
        </div>

        <div class="chart-area">
            @php
                /*
                | WARNA DONUT (Ditambah agar cukup untuk banyak divisi)
                */
                $colors = [
                    '#2785dc',
                    '#ef5350',
                    '#fbbd24',
                    '#22a06b',
                    '#8147c7',
                    '#db2777', // Warna untuk divisi ke-6
                    '#0891b2',
                    '#4b5563'
                ];

                $totalDerajat = 0;
                $gradientParts = [];
                $persentaseDivisi = [];

                /*
                | DIBUANG ->take(5) agar SEMUA DIVISI ikut dihitung
                */
                foreach($divisis as $index => $divisi) {
                    $terisi = $divisi->peserta_magangs_count ?? 0;
                    $kapasitas = $divisi->kapasitas ?? 0;

                    $persentase = $kapasitas > 0
                        ? round(($terisi / $kapasitas) * 100)
                        : 0;

                    $persentase = min($persentase, 100);

                    $persentaseDivisi[] = [
                        'nama' => $divisi->nama_divisi,
                        'persentase' => $persentase
                    ];

                    $derajat = ($persentase / 100) * 360;
                    $awal = $totalDerajat;
                    $akhir = $totalDerajat + $derajat;

                    if($derajat > 0) {
                        $color = $colors[$index % count($colors)];
                        $gradientParts[] = $color . ' ' . $awal . 'deg ' . $akhir . 'deg';
                    }

                    $totalDerajat = $akhir;
                }

                if(empty($gradientParts)) {
                    $gradient = '#e9eef4 0deg 360deg';
                } else {
                    $gradient = implode(', ', $gradientParts);
                    if($totalDerajat < 360) {
                        $gradient .= ', #e9eef4 ' . $totalDerajat . 'deg 360deg';
                    }
                }
            @endphp

            <!-- DONUT CIRCLE -->
            <div class="donut" style="--donut-gradient: conic-gradient({{ $gradient }});">
                <div class="donut-center">
                    @php
                        $totalTerisiDashboard = $divisis->sum('peserta_magangs_count');
                        $totalKapasitasDashboard = $divisis->sum('kapasitas');
                        $persentaseKeseluruhan = $totalKapasitasDashboard > 0
                            ? round(($totalTerisiDashboard / $totalKapasitasDashboard) * 100)
                            : 0;
                    @endphp
                    <div class="donut-center-number">
                        {{ $persentaseKeseluruhan }}%
                    </div>
                    <div class="donut-center-text">
                        Terisi
                    </div>
                </div>
            </div>

            <!-- LEGENDA DINAMIS -->
            <div class="legend">
                @foreach($persentaseDivisi as $index => $data)
                    @php
                        $colorList = ['#2785dc', '#ef5350', '#fbbd24', '#22a06b', '#8147c7', '#db2777', '#0891b2', '#4b5563'];
                        $currentColor = $colorList[$index % count($colorList)];
                    @endphp
                    <div class="legend-item">
                        <span class="legend-dot" style="background-color: {{ $currentColor }};"></span>
                        <span class="legend-name">{{ $data['nama'] }}</span>
                        <span class="legend-percentage">{{ $data['persentase'] }}%</span>
                    </div>
                @endforeach
            </div>
        </div>


</div>
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Ambil label seluruh divisi dari database
        const chartLabels = @json($divisis->pluck('nama_divisi'));
        
        // Hitung persentase keterisian masing-masing divisi
        const chartData = @json($divisis->map(function($d) {
            return $d->kapasitas > 0 ? round(($d->peserta_magangs_count / $d->kapasitas) * 100) : 0;
        }));

        const ctx = document.getElementById('persentaseChart').getContext('2d');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: chartLabels, // Otomatis mengikuti seluruh jumlah divisi
                datasets: [{
                    data: chartData,
                    backgroundColor: [
                        '#2785dc', '#ef5350', '#fbbd24', '#22a06b', 
                        '#8147c7', '#db2777', '#0891b2', '#4b5563', '#16a34a'
                    ],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 12,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.label + ': ' + context.raw + '%';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection

@endsection