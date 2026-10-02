@extends('layouts.admin')

@section('title', 'Upload Jurnal')

@section('page-title', 'Upload Jurnal')

@section('styles')

<style>

    .page-header {
        margin-bottom: 25px;
    }

    .page-header h2 {
        margin: 0;
        font-size: 24px;
        color: #243b53;
    }

    .page-header p {
        margin: 7px 0 0;
        color: #829ab1;
        font-size: 14px;
    }

    .upload-panel {
        background: white;
        border: 1px solid #e8eef4;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 3px 12px rgba(31,45,61,.06);
        max-width: 700px;
    }

    .peserta-info {
        background: #f5f9ff;
        border: 1px solid #dceafb;
        border-radius: 10px;
        padding: 18px;
        margin-bottom: 25px;
    }

    .peserta-info h3 {
        margin: 0 0 12px;
        color: #243b53;
        font-size: 17px;
    }

    .info-row {
        display: flex;
        margin-bottom: 7px;
        font-size: 14px;
    }

    .info-label {
        width: 150px;
        color: #829ab1;
    }

    .info-value {
        font-weight: bold;
        color: #243b53;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-size: 13px;
        font-weight: bold;
        color: #243b53;
    }

    .form-control {
        width: 100%;
        padding: 11px 13px;
        border: 1px solid #d9e3ec;
        border-radius: 7px;
        font-size: 14px;
        background: white;
    }

    .form-control:focus {
        outline: none;
        border-color: #1677e8;
        box-shadow: 0 0 0 3px rgba(22,119,232,.1);
    }

    .help-text {
        margin-top: 7px;
        font-size: 12px;
        color: #829ab1;
    }

    .error {
        color: #d93636;
        font-size: 12px;
        margin-top: 6px;
    }

    .button-group {
        display: flex;
        gap: 10px;
        margin-top: 25px;
    }

    .btn {
        padding: 10px 18px;
        border-radius: 7px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 13px;
        font-weight: bold;
    }

    .btn-primary {
        background: #1677e8;
        color: white;
    }

    .btn-primary:hover {
        background: #0f63c7;
    }

    .btn-secondary {
        background: #edf2f7;
        color: #52606d;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
    }

</style>

@endsection


@section('content')

<div class="page-header">

    <h2>
        Upload Jurnal Peserta
    </h2>

    <p>
        Upload jurnal untuk peserta magang berikut.
    </p>

</div>


<div class="upload-panel">

    <div class="peserta-info">

        <h3>
            Informasi Peserta
        </h3>

        <div class="info-row">

            <div class="info-label">
                Nama
            </div>

            <div class="info-value">
                {{ $peserta->nama }}
            </div>

        </div>


        <div class="info-row">

            <div class="info-label">
                Asal Instansi
            </div>

            <div class="info-value">
                {{ $peserta->asal_instansi }}
            </div>

        </div>


        <div class="info-row">

            <div class="info-label">
                Jurusan
            </div>

            <div class="info-value">
                {{ $peserta->jurusan }}
            </div>

        </div>


        <div class="info-row">

            <div class="info-label">
                Divisi
            </div>

            <div class="info-value">
                {{ $peserta->divisi->nama_divisi ?? '-' }}
            </div>

        </div>

    </div>


    <form
        action="{{ route('jurnal.store', $peserta->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="form-group">

            <label for="jurnal">
                File Jurnal
            </label>

            <input
                type="file"
                name="jurnal"
                id="jurnal"
                class="form-control"
                accept=".pdf"
                required
            >

            <div class="help-text">
                Format yang diperbolehkan: PDF.
            </div>


            @error('jurnal')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror

        </div>


        <div class="button-group">

            <a
                href="{{ route('jurnal.index') }}"
                class="btn btn-secondary"
            >
                ← Kembali
            </a>


            <button
                type="submit"
                class="btn btn-primary"
            >
                📤 Upload Jurnal
            </button>

        </div>

    </form>

</div>

@endsection