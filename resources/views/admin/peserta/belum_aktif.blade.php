@extends('layouts.admin')

@section('title', 'Peserta Belum Aktif')
@section('page-title', 'Peserta Belum Aktif / Booking')

@section('content')
<div class="panel" style="background: white; border: 1px solid #e8eef4; border-radius: 10px; padding: 22px; box-shadow: 0 3px 10px rgba(31, 45, 61, .05);">
    <div class="panel-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
            <h3 style="margin: 0; font-size: 18px; font-weight: bold; color: #243b53;">
                Daftar Peserta Belum Aktif (Booking Periode Datang)
            </h3>
            <p style="margin: 4px 0 0; font-size: 13px; color: #829ab1;">
                Peserta yang sudah terdaftar tetapi tanggal mulai magangnya belum tiba.
            </p>
        </div>
    </div>

    <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
        <thead>
            <tr style="background: #f7f9fb; color: #66788a; font-size: 11px; text-transform: uppercase; font-weight: bold;">
                <th style="padding: 12px 10px; text-align: center;">NO</th>
                <th style="padding: 12px 10px; text-align: left;">NAMA PESERTA</th>
                <th style="padding: 12px 10px; text-align: left;">ASAL SEKOLAH/UNIVERSITAS</th>
                <th style="padding: 12px 10px; text-align: left;">JURUSAN</th>
                <th style="padding: 12px 10px; text-align: left;">DIVISI</th>
                <th style="padding: 12px 10px; text-align: center;">TANGGAL MULAI</th>
                <th style="padding: 12px 10px; text-align: center;">TANGGAL SELESAI</th>
                <th style="padding: 12px 10px; text-align: center;">STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesertas as $index => $item)
                <tr style="border-bottom: 1px solid #edf1f5;">
                    <td style="padding: 14px 10px; text-align: center; font-weight: bold;">{{ $index + 1 }}</td>
                    <td style="padding: 14px 10px; font-weight: bold; color: #243b53;">{{ $item->nama_peserta ?? $item->nama }}</td>
                    <td style="padding: 14px 10px;">{{ $item->asal_instansi ?? '-' }}</td>
                    <td style="padding: 14px 10px;">{{ $item->jurusan }}</td>
                    <td style="padding: 14px 10px;">
                        <span style="background: #e8f3ff; color: #1677e8; padding: 4px 10px; border-radius: 6px; font-weight: 600; font-size: 12px;">
                            {{ $item->divisi->nama_divisi ?? '-' }}
                        </span>
                    </td>
                    <td style="padding: 14px 10px; text-align: center;">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') }}</td>
                    <td style="padding: 14px 10px; text-align: center;">{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') }}</td>
                    <td style="padding: 14px 10px; text-align: center;">
                        <span style="background: #fff3df; color: #ef9b20; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: bold;">
                            Belum Aktif
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 25px; color: #829ab1;">
                        Tidak ada peserta yang belum aktif saat ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection