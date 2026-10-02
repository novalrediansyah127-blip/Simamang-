@extends('layouts.admin')

@section('title', 'Tambah Peserta')

@section('page-title', 'Tambah Peserta Magang')

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
        max-width: 900px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-group {
        margin-bottom: 5px;
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

    .form-help {
        margin-top: 6px;
        font-size: 12px;
        color: #829ab1;
        line-height: 1.5;
    }

    .upload-box {
        border: 1px dashed #c9d6e2;
        border-radius: 8px;
        padding: 12px;
        background: #fafcff;
    }

    .upload-title {
        font-size: 12px;
        color: #52606d;
        margin-bottom: 7px;
    }

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

    @media(max-width: 700px) {

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .form-panel {
            padding: 20px;
        }

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

    <h2>
        Tambah Peserta Magang
    </h2>

    <p>
        Masukkan data peserta magang dengan lengkap.
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
        action="{{ route('peserta.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


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
                    value="{{ old('nama') }}"
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
                    value="{{ old('asal_instansi') }}"
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
                    value="{{ old('jurusan') }}"
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
                    value="{{ old('no_hp') }}"
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
                    value="{{ old('email') }}"
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
                    value="{{ old('tanggal_mulai') }}"
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
                            {{ old('divisi_id') == $divisi->id ? 'selected' : '' }}
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

                <label for="tanggal_selesai">

                    Tanggal Selesai

                    <span class="required">*</span>

                </label>

                <input
                    type="date"
                    id="tanggal_selesai"
                    name="tanggal_selesai"
                    class="form-control"
                    value="{{ old('tanggal_selesai') }}"
                    required
                >

                <div class="form-help">

                    Setelah tanggal ini tercapai, status peserta
                    akan otomatis menjadi Selesai.

                </div>

            </div>


            
<!-- SURAT BALASAN -->
<div class="form-group">
    <label for="foto_surat_balasan">
        Surat Balasan <span class="required">*</span>
    </label>
    <div class="upload-box">
        <div class="upload-title">
            📄 Upload foto surat balasan
        </div>
        <input
            type="file"
            id="foto_surat_balasan"
            name="foto_surat_balasan"
            class="form-control"
            accept=".jpg,.jpeg,.png"
            required
        >
        <div class="form-help">
            JPG, JPEG, atau PNG. Maksimal 2 MB.
        </div>
    </div>
</div>

<!-- FOTO SURAT SEKOLAH -->
<div class="form-group">
    <label for="foto_surat_sekolah">
        Foto Surat Sekolah <span class="required">*</span>
    </label>
    <div class="upload-box">
        <div class="upload-title">
            📷 Upload foto surat sekolah
        </div>
        <input
            type="file"
            id="foto_surat_sekolah"
            name="foto_surat_sekolah"
            class="form-control"
            accept=".jpg,.jpeg,.png"
            required
        >
        <div class="form-help">
            JPG, JPEG, atau PNG. Maksimal 2 MB.
        </div>
    </div>
</div>

<!-- FOTO FORMAL -->
<div class="form-group">
    <label for="foto_formal">
        Foto Formal <span class="required">*</span>
    </label>
    <div class="upload-box">
        <div class="upload-title">
            📷 Upload foto formal peserta
        </div>
        <input
            type="file"
            id="foto_formal"
            name="foto_formal"
            class="form-control"
            accept=".jpg,.jpeg,.png"
            required
        >
        <div class="form-help">
            JPG, JPEG, atau PNG. Maksimal 2 MB.
        </div>
    </div>
</div>


        </div> {{-- Penutup .form-grid --}}


        {{-- ========================= --}}
        {{-- BUTTON (Di Samping Kanan) --}}
        {{-- ========================= --}}

        <div class="form-actions">

            <a
                href="{{ route('peserta.index') }}"
                class="btn btn-secondary"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Simpan
            </button>

        </div>

        </div>


    </form>

</div>

@endsection