@extends('layouts.admin')

@section('title', 'Peserta ' . $divisi->nama_divisi)

@section('page-title', 'Peserta Divisi')

@section('styles')
<style>

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .page-header h2 {
        margin: 0;
        font-size: 25px;
        color: #243b53;
    }

    .page-header p {
        margin: 7px 0 0;
        color: #829ab1;
        font-size: 14px;
    }

    .btn-back {
        padding: 10px 16px;
        background: #e9eef3;
        color: #334e68;
        text-decoration: none;
        border-radius: 7px;
        font-size: 13px;
        font-weight: bold;
    }

    .info-card {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 22px;
    }

    .info-box {
        background: white;
        border: 1px solid #e8eef4;
        border-radius: 10px;
        padding: 18px;
        box-shadow: 0 3px 10px rgba(31,45,61,.05);
    }

    .info-label {
        font-size: 12px;
        color: #829ab1;
        margin-bottom: 6px;
    }

    .info-value {
        font-size: 22px;
        font-weight: bold;
        color: #243b53;
    }

    .table-panel {
        background: white;
        border: 1px solid #e8eef4;
        border-radius: 10px;
        padding: 22px;
        box-shadow: 0 3px 10px rgba(31,45,61,.05);
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
        min-width: 850px;
        font-size: 14px;
    }

    .data-table th {
        text-align: left;
        padding: 13px 10px;
        background: #f7f9fb;
        color: #66788a;
        font-size: 11px;
        text-transform: uppercase;
        border-bottom: 1px solid #e5ebf0;
    }

    .data-table td {
        padding: 14px 10px;
        color: #52606d;
        border-bottom: 1px solid #edf1f5;
    }

    .number {
        font-weight: bold;
        color: #243b53;
    }

    .name {
        font-weight: bold;
        color: #243b53;
    }

    .status {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        background: #e4f7ed;
        color: #11955b;
        font-size: 11px;
        font-weight: bold;
    }

    .empty {
        text-align: center;
        padding: 45px !important;
        color: #829ab1 !important;
    }

    @media(max-width: 700px) {

        .page-header {
            display: block;
        }

        .btn-back {
            display: inline-block;
            margin-top: 15px;
        }

        .info-card {
            grid-template-columns: 1fr;
        }

    }

</style>
@endsection


@section('content')

<div class="page-header">

    <div>

        <h2>
            {{ $divisi->nama_divisi }}
        </h2>

        <p>
            Daftar peserta yang sedang melaksanakan magang di divisi ini.
        </p>

    </div>


    <a
        href="{{ route('monitoring.index') }}"
        class="btn-back"
    >
        ← Kembali
    </a>

</div>


<div class="info-card">

    <div class="info-box">

        <div class="info-label">
            Kapasitas Divisi
        </div>

        <div class="info-value">
            {{ $divisi->kapasitas }} Orang
        </div>

    </div>


    <div class="info-box">

        <div class="info-label">
            Peserta Aktif
        </div>

        <div class="info-value">
            {{ $divisi->pesertas->count() }} Orang
        </div>

    </div>


    <div class="info-box">

        <div class="info-label">
            Sisa Kuota
        </div>

        <div class="info-value">
            {{ max($divisi->kapasitas - $divisi->pesertas->count(), 0) }} Orang
        </div>

    </div>

</div>


<div class="table-panel">

    <div class="table-title">
        Peserta Magang - {{ $divisi->nama_divisi }}
    </div>


    <table class="data-table">

        <thead>

            <tr>

                <th>No</th>

                <th>Nama Peserta</th>

                <th>Asal Instansi</th>

                <th>Jurusan</th>

                <th>Tanggal Mulai</th>

                <th>Tanggal Selesai</th>

                <th>Status</th>

            </tr>

        </thead>


        <tbody>

            @forelse($divisi->pesertas as $index => $peserta)

                <tr>

                    <td class="number">
                        {{ $index + 1 }}
                    </td>

                    <td class="name">
                        {{ $peserta->nama }}
                    </td>

                    <td>
                        {{ $peserta->asal_instansi }}
                    </td>

                    <td>
                        {{ $peserta->jurusan }}
                    </td>

                    <td>
                        {{ $peserta->tanggal_mulai->format('d/m/Y') }}
                    </td>

                    <td>
                        {{ $peserta->tanggal_selesai->format('d/m/Y') }}
                    </td>

                    <td>

                        <span class="status">
                            Aktif
                        </span>

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="7"
                        class="empty"
                    >

                        👥

                        <br><br>

                        Belum ada peserta aktif di divisi ini.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection