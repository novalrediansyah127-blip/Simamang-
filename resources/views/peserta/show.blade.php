@extends('layouts.admin')

@section('title', 'Detail Peserta')

@section('page-title', 'Detail Peserta Magang')

@section('styles')

<style>

    .detail-header {
        margin-bottom: 25px;
    }

    .detail-header h2 {
        margin: 0;
        font-size: 24px;
        color: #243b53;
    }

    .detail-header p {
        margin: 7px 0 0;
        font-size: 14px;
        color: #829ab1;
    }

    .detail-panel {
        background: white;
        border: 1px solid #e8eef4;
        border-radius: 10px;
        padding: 28px;
        max-width: 1000px;
        box-shadow: 0 3px 10px rgba(31, 45, 61, .05);
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .detail-item {
        padding: 16px;
        background: #f7f9fb;
        border: 1px solid #edf1f5;
        border-radius: 8px;
    }

    .detail-item.full {
        grid-column: 1 / -1;
    }

    .detail-label {
        font-size: 12px;
        color: #829ab1;
        margin-bottom: 7px;
        font-weight: bold;
    }

    .detail-value {
        font-size: 15px;
        color: #243b53;
        font-weight: 600;
    }

    .status {
        display: inline-block;
        padding: 5px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }

    .status-aktif {
        background: #e4f7ed;
        color: #11955b;
    }

    .status-selesai {
        background: #e8f3ff;
        color: #1677e8;
    }

    /* FOTO */

    .photo-section {
        grid-column: 1 / -1;
        margin-top: 5px;
    }

    .photo-title {
        font-size: 16px;
        font-weight: bold;
        color: #243b53;
        margin-bottom: 15px;
    }

    .photo-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .photo-card {
        background: #f7f9fb;
        border: 1px solid #edf1f5;
        border-radius: 8px;
        padding: 16px;
    }

    .photo-card-title {
        font-size: 13px;
        font-weight: bold;
        color: #334e68;
        margin-bottom: 12px;
    }

    .photo-box {
        width: 100%;
        height: 300px;
        background: #ffffff;
        border: 1px solid #d9e2ec;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .photo-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    .photo-empty {
        text-align: center;
        color: #829ab1;
        font-size: 13px;
    }

    .photo-empty-icon {
        font-size: 35px;
        margin-bottom: 8px;
    }

    .detail-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #edf1f5;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 16px;
        border-radius: 7px;
        font-size: 13px;
        font-weight: bold;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .btn-back {
        background: #e9eef3;
        color: #334e68;
    }

    .btn-back:hover {
        background: #dce4eb;
    }

    .btn-edit {
        background: #1677e8;
        color: white;
    }

    .btn-edit:hover {
        background: #0f62c4;
    }

    @media(max-width: 700px) {

        .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-item.full {
            grid-column: auto;
        }

        .photo-section {
            grid-column: auto;
        }

        .photo-grid {
            grid-template-columns: 1fr;
        }

        .photo-box {
            height: 250px;
        }

        .detail-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }

    }

</style>

@endsection


@section('content')

<div class="detail-header">

    <h2>
        Detail Peserta Magang
    </h2>

    <p>
        Informasi lengkap peserta magang.
    </p>

</div>


<div class="detail-panel">

    <div class="detail-grid">


        {{-- Nama --}}

        <div class="detail-item full">

            <div class="detail-label">
                Nama Peserta
            </div>

            <div class="detail-value">
                {{ $peserta->nama }}
            </div>

        </div>


        {{-- Asal Instansi --}}

        <div class="detail-item">

            <div class="detail-label">
                Asal Instansi
            </div>

            <div class="detail-value">
                {{ $peserta->asal_instansi }}
            </div>

        </div>


        {{-- Jurusan --}}

        <div class="detail-item">

            <div class="detail-label">
                Jurusan
            </div>

            <div class="detail-value">
                {{ $peserta->jurusan }}
            </div>

        </div>


        {{-- Nomor HP --}}

        <div class="detail-item">

            <div class="detail-label">
                Nomor HP
            </div>

            <div class="detail-value">
                {{ $peserta->no_hp }}
            </div>

        </div>


        {{-- Email --}}

        <div class="detail-item">

            <div class="detail-label">
                Email
            </div>

            <div class="detail-value">
                {{ $peserta->email ?? '-' }}
            </div>

        </div>


        {{-- Divisi --}}

        <div class="detail-item">

            <div class="detail-label">
                Divisi
            </div>

            <div class="detail-value">

                @if($peserta->divisi)

                    {{ $peserta->divisi->kode_divisi }}
                    -
                    {{ $peserta->divisi->nama_divisi }}

                @else

                    -

                @endif

            </div>

        </div>


        {{-- Status --}}

        <div class="detail-item">

            <div class="detail-label">
                Status
            </div>

            <div class="detail-value">

                @if($peserta->status == 'Aktif')

                    <span class="status status-aktif">
                        Aktif
                    </span>

                @else

                    <span class="status status-selesai">
                        Selesai
                    </span>

                @endif

            </div>

        </div>


        {{-- Tanggal Mulai --}}

        <div class="detail-item">

            <div class="detail-label">
                Tanggal Mulai
            </div>

            <div class="detail-value">

                {{ $peserta->tanggal_mulai
                    ? $peserta->tanggal_mulai->format('d/m/Y')
                    : '-' }}

            </div>

        </div>


        {{-- Tanggal Selesai --}}

        <div class="detail-item">

            <div class="detail-label">
                Tanggal Selesai
            </div>

            <div class="detail-value">

                {{ $peserta->tanggal_selesai
                    ? $peserta->tanggal_selesai->format('d/m/Y')
                    : '-' }}

            </div>

        </div>


<!-- 2. FOTO SURAT Balasan -->
<div style="width: 100%;">
    <label style="font-weight: 700; color: #1e293b; margin-bottom: 8px; font-size: 14px; display: block;">
        Foto Surat Balasan <span style="color: #ef4444;">*</span>
    </label>
    
    <div style="background-color: #ffffff; border: 1px dashed #cbd5e1; border-radius: 12px; padding: 16px; width: 100%; box-sizing: border-box;">
        <div style="color: #64748b; font-size: 13px; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
            <span>📷</span> Upload foto surat balasan
        </div>
        
        <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px 12px; display: flex; align-items: center; gap: 10px; margin-bottom: 8px; width: 100%; box-sizing: border-box;">
            @if(!empty($peserta->foto_surat_balasan))
                <a href="{{ asset('storage/' . $peserta->foto_surat_balasan) }}" target="_blank" style="background-color: #e0f2fe; color: #0284c7; font-weight: 700; font-size: 13px; padding: 6px 16px; border-radius: 6px; text-decoration: none; display: inline-block; white-space: nowrap;">
                    Lihat Foto
                </a>
                <span style="color: #475569; font-size: 13px; word-break: break-all;">foto_surat_balasan.jpg</span>
            @else
                <span style="background-color: #e0f2fe; color: #0284c7; font-weight: 700; font-size: 13px; padding: 6px 16px; border-radius: 6px; opacity: 0.6; cursor: not-allowed; white-space: nowrap;">
                    Lihat Foto
                </span>
                <span style="color: #94a3b8; font-size: 13px;">Tidak ada file</span>
            @endif
        </div>
        
        <span style="color: #94a3b8; font-size: 12px; display: block;">JPG, JPEG, atau PNG. Maksimal 2 MB.</span>
    </div>
</div>

<!-- 2. FOTO SURAT SEKOLAH -->
<div style="width: 100%;">
    <label style="font-weight: 700; color: #1e293b; margin-bottom: 8px; font-size: 14px; display: block;">
        Foto Surat Sekolah <span style="color: #ef4444;">*</span>
    </label>
    
    <div style="background-color: #ffffff; border: 1px dashed #cbd5e1; border-radius: 12px; padding: 16px; width: 100%; box-sizing: border-box;">
        <div style="color: #64748b; font-size: 13px; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
            <span>📷</span> Upload foto surat sekolah
        </div>
        
        <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px 12px; display: flex; align-items: center; gap: 10px; margin-bottom: 8px; width: 100%; box-sizing: border-box;">
            @if(!empty($peserta->foto_surat_sekolah))
                <a href="{{ asset('storage/' . $peserta->foto_surat_sekolah) }}" target="_blank" style="background-color: #e0f2fe; color: #0284c7; font-weight: 700; font-size: 13px; padding: 6px 16px; border-radius: 6px; text-decoration: none; display: inline-block; white-space: nowrap;">
                    Lihat Foto
                </a>
                <span style="color: #475569; font-size: 13px; word-break: break-all;">foto_surat_sekolah.jpg</span>
            @else
                <span style="background-color: #e0f2fe; color: #0284c7; font-weight: 700; font-size: 13px; padding: 6px 16px; border-radius: 6px; opacity: 0.6; cursor: not-allowed; white-space: nowrap;">
                    Lihat Foto
                </span>
                <span style="color: #94a3b8; font-size: 13px;">Tidak ada file</span>
            @endif
        </div>
        
        <span style="color: #94a3b8; font-size: 12px; display: block;">JPG, JPEG, atau PNG. Maksimal 2 MB.</span>
    </div>
</div>

<!-- 3. FOTO FORMAL -->
<div style="width: 100%;">
    <label style="font-weight: 700; color: #1e293b; margin-bottom: 8px; font-size: 14px; display: block;">
        Foto Formal <span style="color: #ef4444;">*</span>
    </label>
    
    <div style="background-color: #ffffff; border: 1px dashed #cbd5e1; border-radius: 12px; padding: 16px; width: 100%; box-sizing: border-box;">
        <div style="color: #64748b; font-size: 13px; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
            <span>📷</span> Upload foto formal peserta
        </div>
        
        <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px 12px; display: flex; align-items: center; gap: 10px; margin-bottom: 8px; width: 100%; box-sizing: border-box;">
            @if(!empty($peserta->foto_formal))
                <a href="{{ asset('storage/' . $peserta->foto_formal) }}" target="_blank" style="background-color: #e0f2fe; color: #0284c7; font-weight: 700; font-size: 13px; padding: 6px 16px; border-radius: 6px; text-decoration: none; display: inline-block; white-space: nowrap;">
                    Lihat Foto
                </a>
                <span style="color: #475569; font-size: 13px; word-break: break-all;">foto_formal.jpg</span>
            @else
                <span style="background-color: #e0f2fe; color: #0284c7; font-weight: 700; font-size: 13px; padding: 6px 16px; border-radius: 6px; opacity: 0.6; cursor: not-allowed; white-space: nowrap;">
                    Lihat Foto
                </span>
                <span style="color: #94a3b8; font-size: 13px;">Tidak ada file</span>
            @endif
        </div>
        
        <span style="color: #94a3b8; font-size: 12px; display: block;">JPG, JPEG, atau PNG. Maksimal 2 MB.</span>
    </div>
</div>

    </div> {{-- Penutup .detail-grid --}}
    {{-- BUTTON --}}

    <div class="detail-actions">

        <a
            href="{{ route('peserta.index') }}"
            class="btn btn-back"
        >
            ← Kembali
        </a>

        <a
            href="{{ route('peserta.edit', $peserta->id) }}"
            class="btn btn-edit"
        >
            ✏️ Edit Peserta
        </a>

    </div>


</div>

@endsection