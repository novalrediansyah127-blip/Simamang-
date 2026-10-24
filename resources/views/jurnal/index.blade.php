@extends('layouts.admin')

@section('title', 'List Jurnal')

@section('page-title', 'List Jurnal')

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
        font-size: 24px;
        color: #243b53;
    }

    .page-header p {
        margin: 7px 0 0;
        font-size: 14px;
        color: #829ab1;
    }

    .alert-success {
        background: #e7f8ef;
        color: #147d4d;
        border: 1px solid #c8eedb;
        padding: 13px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
    }

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
        vertical-align: middle;
    }

    .data-table tr:last-child td {
        border-bottom: none;
    }

    .data-table tr:hover td {
        background: #fafcff;
    }

    .number {
        font-weight: bold;
        color: #243b53;
    }

    .name {
        font-weight: bold;
        color: #243b53;
    }

    .division {
        display: inline-block;
        padding: 5px 10px;
        background: #e8f3ff;
        color: #1769aa;
        border-radius: 6px;
        font-size: 12px;
        font-weight: bold;
    }

    .status {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
    }

    .status-uploaded {
        background: #e4f7ed;
        color: #11955b;
    }

    .status-pending {
        background: #fff2d7;
        color: #d89100;
    }

    .action-group {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 7px 10px;
        border-radius: 6px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 12px;
        font-weight: bold;
    }

    .btn-upload {
        background: #e8f3ff;
        color: #1769aa;
    }

    .btn-view {
        background: #e4f7ed;
        color: #11955b;
    }

    .btn-delete {
        background: #ffe7e7;
        color: #d93636;
    }

    .btn-action:hover {
        opacity: .8;
    }

    /* NILAI */

    .nilai-form {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .nilai-input {
        width: 65px;
        height: 34px;
        padding: 0 8px;
        border: 1px solid #dbe3eb;
        border-radius: 6px;
        outline: none;
        font-size: 12px;
        text-align: center;
    }

    .nilai-input:focus {
        border-color: #1478e6;
        box-shadow: 0 0 0 2px rgba(20,120,230,.1);
    }

    .btn-nilai {
        background: #e8f3ff;
        color: #1769aa;
        padding: 7px 10px;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: bold;
        cursor: pointer;
    }

    .btn-nilai:hover {
        opacity: .8;
    }

    .nilai-sudah {
        display: inline-block;
        min-width: 45px;
        padding: 7px 10px;
        background: #e4f7ed;
        color: #11955b;
        border-radius: 6px;
        font-weight: bold;
        text-align: center;
    }

    .belum-nilai {
        color: #d89100;
        font-size: 12px;
        font-weight: bold;
    }

    .file-name {
        font-size: 12px;
        color: #52606d;
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

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

</style>

@endsection


@section('content')

<div class="page-header">

    <div>

        <h2>
            List Jurnal Peserta
        </h2>

        <p>
            Kelola jurnal peserta magang yang sedang aktif.
        </p>

    </div>

</div>


@if(session('success'))

    <div class="alert-success">
        {{ session('success') }}
    </div>

@endif


<div class="table-panel">

    <div class="table-title">
        Daftar Jurnal Peserta Magang
    </div>


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

                <th>Status Jurnal</th>

                <th>Status Magang</th>

                <th>Nilai</th>

                <th>Aksi</th>

            </tr>

        </thead>


        <tbody>

            @forelse($pesertas as $index => $peserta)

                <tr>

                    {{-- NO --}}
                    <td class="number">
                        {{ $index + 1 }}
                    </td>


                    {{-- NAMA --}}
                    <td class="name">
                        {{ $peserta->nama }}
                    </td>


                    {{-- ASAL INSTANSI --}}
                    <td>
                        {{ $peserta->asal_instansi }}
                    </td>


                    {{-- JURUSAN --}}
                    <td>
                        {{ $peserta->jurusan }}
                    </td>


                    {{-- DIVISI --}}
                    <td>

                        <span class="division">
                            {{ $peserta->divisi->nama_divisi ?? '-' }}
                        </span>

                    </td>


                    {{-- TANGGAL MULAI --}}
                    <td>
                        {{ $peserta->tanggal_mulai->format('d/m/Y') }}
                    </td>


                    {{-- TANGGAL SELESAI --}}
                    <td>
                        {{ $peserta->tanggal_selesai->format('d/m/Y') }}
                    </td>


                    {{-- STATUS JURNAL --}}
                    <td>

                        @if($peserta->jurnal)

                            <span class="status status-uploaded">
                                ✓ Sudah Upload
                            </span>

                        @else

                            <span class="status status-pending">
                                Belum Upload
                            </span>

                        @endif

                    </td>


                    {{-- STATUS MAGANG (Kolom Baru) --}}
                    <td>
                        @if($peserta->status == 'Aktif')
                            <span style="display: inline-block; padding: 6px 11px; background: #e4f7ed; color: #11955b; border-radius: 20px; font-size: 11px; font-weight: bold;">
                                Aktif
                            </span>
                        @else
                            <span style="display: inline-block; padding: 6px 11px; background: #e8f3ff; color: #1769aa; border-radius: 20px; font-size: 11px; font-weight: bold;">
                                PKL Selesai
                            </span>
                        @endif
                    </td>

                    {{-- NILAI --}}
                    <td>

                        @if($peserta->jurnal)

                            {{-- JIKA SUDAH ADA NILAI --}}
                            @if($peserta->jurnal->nilai !== null)

                                <span class="nilai-sudah">
                                    {{ $peserta->jurnal->nilai }}
                                </span>

                            {{-- JIKA BELUM ADA NILAI --}}
                            @else

                                <form
                                    action="{{ route('jurnal.nilai', $peserta->jurnal->id) }}"
                                    method="POST"
                                    class="nilai-form"
                                >

                                    @csrf
                                    @method('PUT')

                                    <input
                                        type="number"
                                        name="nilai"
                                        class="nilai-input"
                                        min="0"
                                        max="100"
                                        step="1"
                                        placeholder="Nilai"
                                        required
                                    >

                                    <button
                                        type="submit"
                                        class="btn-nilai"
                                    >
                                        Simpan
                                    </button>

                                </form>

                            @endif

                        @else

                            {{-- BELUM UPLOAD JURNAL --}}
                            <span style="color:#9aa8b5;">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- AKSI --}}
                    <td>

                        <div class="action-group">

                            @if($peserta->jurnal)

                                {{-- LIHAT JURNAL --}}
                                <a
                                    href="{{ route('jurnal.view', $peserta->jurnal->id) }}"
                                    class="btn-action btn-view"
                                    target="_blank"
                                >
                                    👁 Lihat
                                </a>

                            @endif


                            {{-- UPLOAD / GANTI --}}
                            <a
                                href="{{ route('jurnal.create', $peserta->id) }}"
                                class="btn-action btn-upload"
                            >
                                {{ $peserta->jurnal ? 'Ganti' : 'Upload' }}
                            </a>


                            @if($peserta->jurnal)

                                {{-- HAPUS JURNAL --}}
                                <form
                                    action="{{ route('jurnal.destroy', $peserta->jurnal->id) }}"
                                    method="POST"
                                    style="display:inline"
                                    onsubmit="return confirm('Yakin ingin menghapus jurnal ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-action btn-delete"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            @endif

                        </div>

                    </td>

                </tr>


            @empty

                <tr>

                    <td
                        colspan="10"
                        class="empty"
                    >

                        <div class="empty-icon">
                            📋
                        </div>

                        Belum ada peserta magang aktif.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection