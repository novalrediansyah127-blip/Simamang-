@extends('layouts.admin')

@section('title', 'Edit Peserta')

@section('page-title', 'Edit Peserta Magang')

@section('styles')

<style>

    .form-header {
        margin-bottom: 25px;
    }

    .form-header h2 {
        margin: 0;
        font-size: 24px;
        color: #243b53;
    }

    .form-header p {
        margin: 7px 0 0;
        font-size: 14px;
        color: #829ab1;
    }

    .form-panel {
        background: white;
        border: 1px solid #e8eef4;
        border-radius: 10px;
        padding: 28px;
        box-shadow: 0 3px 10px rgba(31, 45, 61, .05);
        max-width: 1100px;
    }

    /* =========================
       FORM GRID
    ========================= */

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
        align-items: start;
    }

    .form-group {
        margin-bottom: 5px;
        min-width: 0;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: bold;
        color: #334e68;
    }

    .required {
        color: #d93636;
    }

    /* =========================
       INPUT
    ========================= */

    .form-control {
        width: 100%;
        padding: 12px 13px;
        border: 1px solid #d9e2ec;
        border-radius: 7px;
        background: white;
        color: #243b53;
        font-size: 14px;
        font-family: inherit;
        transition: .2s;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #1677e8;
        box-shadow: 0 0 0 3px rgba(22, 119, 232, .10);
    }

    select.form-control {
        cursor: pointer;
    }

    input[type="file"].form-control {
        padding: 9px 10px;
        cursor: pointer;
    }

    input[type="file"].form-control::file-selector-button {
        margin-right: 10px;
        padding: 7px 12px;
        border: none;
        border-radius: 5px;
        background: #e8f3ff;
        color: #1769aa;
        font-size: 12px;
        font-weight: bold;
        cursor: pointer;
    }

    /* =========================
       HELP TEXT
    ========================= */

    .form-help {
        margin-top: 6px;
        font-size: 12px;
        color: #829ab1;
        line-height: 1.5;
    }

    /* =========================
       UPLOAD ROW
    ========================= */

    .upload-row {
        grid-column: 1 / -1;

        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;

        align-items: start;
    }

    .upload-row .form-group {
        margin-bottom: 0;
        min-width: 0;
    }

    /* =========================
       UPLOAD BOX
    ========================= */

    .upload-box {
        width: 100%;
        border: 1px dashed #c9d6e2;
        border-radius: 8px;
        padding: 12px;
        background: #fafcff;
        box-sizing: border-box;
    }

    .upload-title {
        font-size: 12px;
        color: #52606d;
        margin-bottom: 7px;
    }

    /* =========================
       FILE PREVIEW
    ========================= */

    .current-file {
        display: flex;
        align-items: center;
        gap: 12px;

        width: 100%;
        min-height: 90px;

        margin-bottom: 12px;
        padding: 10px;

        background: #f4f8fc;
        border-radius: 7px;

        box-sizing: border-box;
    }

    .current-file img {
        width: 75px;
        height: 75px;

        flex-shrink: 0;

        object-fit: cover;

        border-radius: 6px;
        border: 1px solid #d9e2ec;

        background: white;
    }

    .current-file-info {
        min-width: 0;
    }

    .current-file-title {
        font-size: 13px;
        font-weight: bold;
        color: #1677e8;
        margin-bottom: 4px;
    }

    .current-file-text {
        font-size: 11px;
        color: #829ab1;
        line-height: 1.4;
    }

    .no-file {
        padding: 10px;
        margin-bottom: 12px;

        background: #fff5f5;
        border-radius: 7px;

        color: #d93636;
        font-size: 12px;
    }

    /* =========================
       ERROR
    ========================= */

    .error-box {
        background: #fff0f0;
        border: 1px solid #ffd1d1;
        color: #d93636;
        padding: 13px 16px;
        border-radius: 8px;
        margin-bottom: 22px;
        font-size: 13px;
    }

    .error-box ul {
        margin: 7px 0 0 18px;
        padding: 0;
    }

    /* =========================
       BUTTON
    ========================= */

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;

        margin-top: 28px;
        padding-top: 22px;

        border-top: 1px solid #edf1f5;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 11px 18px;

        border: none;
        border-radius: 7px;

        font-size: 14px;
        font-weight: bold;

        text-decoration: none;
        cursor: pointer;

        transition: .2s;
    }

    .btn-primary {
        background: #1677e8;
        color: white;
    }

    .btn-primary:hover {
        background: #0f62c4;
    }

    .btn-secondary {
        background: #e9eef3;
        color: #334e68;
    }

    .btn-secondary:hover {
        background: #dce4eb;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media(max-width: 800px) {

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .upload-row {
            grid-column: auto;
            grid-template-columns: 1fr;
        }

        .form-panel {
            padding: 20px;
        }

    }

    @media(max-width: 700px) {

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }

    }

</style>

@endsection


@section('content')

<div class="form-header">

    <p>
        Masukkan perubahan data peserta magang.
    </p>

</div>


@if($errors->any())

    <div class="error-box">

        <strong>
            Data belum dapat disimpan.
        </strong>

        <ul>

            @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


<div class="form-panel">

    <form
        action="{{ route('peserta.update', $peserta->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        @method('PUT')


        <div class="form-grid">


            {{-- ========================= --}}
            {{-- NAMA PESERTA --}}
            {{-- ========================= --}}

            <div class="form-group full">

                <label for="nama">
                    Nama Peserta
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="nama"
                    name="nama"
                    class="form-control"
                    value="{{ old('nama', $peserta->nama) }}"
                    placeholder="Masukkan nama lengkap peserta"
                    required
                >

            </div>


            {{-- ========================= --}}
            {{-- ASAL INSTANSI --}}
            {{-- ========================= --}}

            <div class="form-group">

                <label for="asal_instansi">
                    Asal Instansi
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="asal_instansi"
                    name="asal_instansi"
                    class="form-control"
                    value="{{ old('asal_instansi', $peserta->asal_instansi) }}"
                    placeholder="Contoh: Universitas Teknologi Bandung"
                    required
                >

            </div>


            {{-- ========================= --}}
            {{-- JURUSAN --}}
            {{-- ========================= --}}

            <div class="form-group">

                <label for="jurusan">
                    Jurusan
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="jurusan"
                    name="jurusan"
                    class="form-control"
                    value="{{ old('jurusan', $peserta->jurusan) }}"
                    placeholder="Contoh: Teknik Informatika"
                    required
                >

            </div>


            {{-- ========================= --}}
            {{-- NOMOR HP --}}
            {{-- ========================= --}}

            <div class="form-group">

                <label for="no_hp">
                    Nomor HP
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="no_hp"
                    name="no_hp"
                    class="form-control"
                    value="{{ old('no_hp', $peserta->no_hp) }}"
                    placeholder="Contoh: 081234567890"
                    required
                >

            </div>


            {{-- ========================= --}}
            {{-- EMAIL --}}
            {{-- ========================= --}}

            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $peserta->email) }}"
                    placeholder="Contoh: peserta@email.com"
                >

                <div class="form-help">
                    Email bersifat opsional.
                </div>

            </div>


            {{-- ========================= --}}
            {{-- TANGGAL MULAI --}}
            {{-- ========================= --}}

            <div class="form-group">

                <label for="tanggal_mulai">
                    Tanggal Mulai
                    <span class="required">*</span>
                </label>

                <input
                    type="date"
                    id="tanggal_mulai"
                    name="tanggal_mulai"
                    class="form-control"
                    value="{{ old(
                        'tanggal_mulai',
                        $peserta->tanggal_mulai
                            ? $peserta->tanggal_mulai->format('Y-m-d')
                            : ''
                    ) }}"
                    required
                >

            </div>


            {{-- ========================= --}}
            {{-- DIVISI --}}
            {{-- ========================= --}}

            <div class="form-group">

                <label for="divisi_id">
                    Divisi
                    <span class="required">*</span>
                </label>

                <select
                    id="divisi_id"
                    name="divisi_id"
                    class="form-control"
                    required
                >

                    <option value="">
                        -- Pilih Divisi --
                    </option>

                    @foreach($divisis as $divisi)

                        <option
                            value="{{ $divisi->id }}"
                            {{ old('divisi_id', $peserta->divisi_id) == $divisi->id ? 'selected' : '' }}
                        >

                            {{ $divisi->kode_divisi }} -
                            {{ $divisi->nama_divisi }}

                        </option>

                    @endforeach

                </select>

            </div>


           {{-- ========================= --}}
            {{-- TANGGAL SELESAI --}}
            {{-- ========================= --}}
           <div class="form-group">
    <label class="form-label" for="tanggal_selesai">Tanggal Selesai</label>
    <input 
        type="date" 
        id="tanggal_selesai" 
        name="tanggal_selesai" 
        class="form-control" 
        value="{{ old('tanggal_selesai', $peserta->tanggal_selesai ? \Carbon\Carbon::parse($peserta->tanggal_selesai)->format('Y-m-d') : '') }}"
    >
    <div class="form-help">
        Setelah tanggal ini tercapai, status peserta akan otomatis menjadi Selesai.
    </div>
</div>

           <!-- SURAT BALASAN -->
<div class="form-group mb-3">
    <label class="font-weight-bold">Foto Surat Balasan <span class="text-danger">*</span></label>
    
    @if(isset($peserta->foto_surat_balasan) && $peserta->foto_surat_balasan)
        <div class="mb-2">
            <p class="mb-1 text-muted small">Foto Saat Ini:</p>
            <a href="{{ asset('storage/' . $peserta->foto_surat_balasan) }}" target="_blank">
                <img src="{{ asset('storage/' . $peserta->foto_surat_balasan) }}" 
                     alt="Foto Surat Balasan" 
                     style="max-height: 150px; border-radius: 8px; border: 1px solid #ddd; padding: 4px;">
            </a>
        </div>
    @endif

    <div class="custom-file-upload">
        <small class="text-muted">📷 Upload foto surat balasan baru (opsional)</small>
        <input type="file" name="foto_surat_balasan" class="form-control mt-1" accept="image/*">
        <small class="text-muted d-block mt-1">JPG, JPEG, atau PNG. Maksimal 2 MB. Kosongkan jika tidak diubah.</small>
    </div>
</div>

            <!-- FOTO SURAT SEKOLAH -->
<div class="form-group mb-3">
    <label class="font-weight-bold">Foto Surat Sekolah <span class="text-danger">*</span></label>
    
    @if(isset($peserta->foto_surat_sekolah) && $peserta->foto_surat_sekolah)
        <div class="mb-2">
            <p class="mb-1 text-muted small">Foto Saat Ini:</p>
            <a href="{{ asset('storage/' . $peserta->foto_surat_sekolah) }}" target="_blank">
                <img src="{{ asset('storage/' . $peserta->foto_surat_sekolah) }}" 
                     alt="Foto Surat Sekolah" 
                     style="max-height: 150px; border-radius: 8px; border: 1px solid #ddd; padding: 4px;">
            </a>
        </div>
    @endif

    <div class="custom-file-upload">
        <small class="text-muted">📷 Upload foto surat sekolah baru (opsional)</small>
        <input type="file" name="foto_surat_sekolah" class="form-control mt-1" accept="image/*">
        <small class="text-muted d-block mt-1">JPG, JPEG, atau PNG. Maksimal 2 MB. Kosongkan jika tidak diubah.</small>
    </div>
</div>

<!-- FOTO FORMAL -->
<div class="form-group mb-3">
    <label class="font-weight-bold">Foto Formal <span class="text-danger">*</span></label>
    
    @if(isset($peserta->foto_formal) && $peserta->foto_formal)
        <div class="mb-2">
            <p class="mb-1 text-muted small">Foto Saat Ini:</p>
            <a href="{{ asset('storage/' . $peserta->foto_formal) }}" target="_blank">
                <img src="{{ asset('storage/' . $peserta->foto_formal) }}" 
                     alt="Foto Formal" 
                     style="max-height: 150px; border-radius: 8px; border: 1px solid #ddd; padding: 4px;">
            </a>
        </div>
    @endif

    <div class="custom-file-upload">
        <small class="text-muted">📷 Upload foto formal peserta baru (opsional)</small>
        <input type="file" name="foto_formal" class="form-control mt-1" accept="image/*">
        <small class="text-muted d-block mt-1">JPG, JPEG, atau PNG. Maksimal 2 MB. Kosongkan jika tidak diubah.</small>
    </div>
</div>

        {{-- ========================= --}}
        {{-- BUTTON (SAMPING KANAN) --}}
        {{-- ========================= --}}

       <form action="{{ route('peserta.update', $peserta->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- GRID DUA KOLOM UNTUK INPUT FORM -->
    <div class="row">
        <!-- KOLOM KIRI -->
        <div class="col-md-6">
            <!-- Input Tanggal, Foto Surat Sekolah, dll -->
        </div>

        <!-- KOLOM KANAN -->
        <div class="col-md-6">
            <!-- Input Surat Balasan, Foto Formal, dll -->

        </div>
    </div> 
    <!-- BARIS GRID BERAKHIR DI SINI -->


    <!-- TOMBOL SIMPAN & BATAL DIARAHKAN KE PADA BAGIAN LUAR GRID -->
    <div style="text-align: right; margin-top: 24px; padding-top: 16px; border-top: 1px solid #e2e8f0;">
        <a href="{{ route('peserta.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>

</form>

</div>


@endsection