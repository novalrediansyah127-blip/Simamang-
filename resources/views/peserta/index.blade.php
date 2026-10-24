@extends('layouts.admin')

@section('title', 'Data Peserta')

@section('page-title')

@section('styles')

<style>

    /* ================= PAGE HEADER ================= */

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


    /* ================= TAMBAH PESERTA ================= */

    .btn-add {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        padding: 11px 18px;

        background: #1677e8;
        color: white;

        border-radius: 8px;

        text-decoration: none;

        font-size: 14px;
        font-weight: bold;

        transition: .2s;
    }

    .btn-add:hover {
        background: #0f62c4;
    }


    /* ================= ALERT ================= */

    .alert-success {
        background: #e7f8ef;
        color: #147d4d;

        border: 1px solid #c8eedb;

        padding: 13px 16px;

        border-radius: 8px;

        margin-bottom: 20px;

        font-size: 14px;
    }


    /* ================= TABLE PANEL ================= */

    .table-panel {
        background: white;

        border: 1px solid #e8eef4;

        border-radius: 10px;

        padding: 22px;

        box-shadow:
            0 3px 10px rgba(31, 45, 61, .05);

        overflow-x: auto;
    }

    .table-title {
        font-size: 17px;
        font-weight: bold;

        color: #243b53;

        margin-bottom: 18px;
    }


    /* ================= TABLE ================= */

    .data-table {
        width: 100%;

        border-collapse: collapse;

        min-width: 950px;

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


    /* ================= TEXT ================= */

    .number {
        font-weight: bold;
        color: #243b53;
    }

    .name {
        font-weight: bold;
        color: #243b53;
    }


    /* ================= DIVISI ================= */

    .division {
        display: inline-block;

        padding: 5px 10px;

        background: #e8f3ff;

        color: #1769aa;

        border-radius: 6px;

        font-size: 12px;

        font-weight: bold;
    }


    /* ================= STATUS ================= */

    .status {
        display: inline-block;

        padding: 6px 11px;

        border-radius: 20px;

        font-size: 11px;

        font-weight: bold;
    }

    .status-active {
        background: #e4f7ed;
        color: #11955b;
    }

    .status-finished {
        background: #edf0f3;
        color: #66788a;
    }


    /* ================= ACTION ================= */

    .action-group {
        display: flex;

        align-items: center;

        gap: 6px;
    }

    .btn-action {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        min-width: 58px;

        padding: 8px 12px;

        border-radius: 6px;

        text-decoration: none;

        border: none;

        cursor: pointer;

        font-family: Arial, Helvetica, sans-serif;

        font-size: 12px;

        font-weight: bold;

        transition: .2s;
    }


    /* DETAIL */

    .btn-detail {
        background: #e8f3ff;

        color: #1769aa;
    }

    .btn-detail:hover {
        background: #d5eaff;
    }


    /* EDIT */

    .btn-edit {
        background: #fff3df;

        color: #c47d00;
    }

    .btn-edit:hover {
        background: #ffe8c2;
    }


    /* HAPUS */

    .btn-delete {
        background: #ffe7e7;

        color: #d93636;
    }

    .btn-delete:hover {
        background: #ffd2d2;
    }


    /* ================= EMPTY ================= */

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


    /* ================= DELETE MODAL ================= */

    .delete-modal {

        display: none;

        position: fixed;

        inset: 0;

        background: rgba(0, 0, 0, .45);

        z-index: 9999;

        align-items: center;

        justify-content: center;

    }

    .delete-modal.show {
        display: flex;
    }


    .delete-modal-box {

        width: 390px;

        max-width: calc(100% - 40px);

        background: white;

        border-radius: 12px;

        padding: 30px;

        text-align: center;

        box-shadow:
            0 12px 40px rgba(0, 0, 0, .22);

        animation: deletePopup .2s ease;

    }


    @keyframes deletePopup {

        from {
            transform: scale(.85);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }

    }


    /* ICON PERINGATAN */

    .warning-icon {

        width: 65px;
        height: 65px;

        margin: 0 auto 15px;

        border: 3px solid #f5b942;

        border-radius: 50%;

        color: #f5b942;

        font-size: 40px;

        font-weight: bold;

        display: flex;

        align-items: center;

        justify-content: center;

    }


    .delete-modal-box h2 {

        margin: 5px 0 8px;

        font-size: 21px;

        color: #243b53;

    }


    .delete-modal-box p {

        margin: 0 0 25px;

        color: #829ab1;

        font-size: 14px;

    }


    /* ================= MODAL BUTTON ================= */

    .delete-actions {

        display: flex;

        justify-content: center;

        gap: 10px;

    }


    .delete-actions button {

        min-width: 105px;

        border: none;

        padding: 10px 18px;

        border-radius: 6px;

        font-family: Arial, Helvetica, sans-serif;

        font-size: 13px;

        font-weight: bold;

        cursor: pointer;

        transition: .2s;

    }


    .delete-confirm {

        background: #d93636;

        color: white;

    }

    .delete-confirm:hover {

        background: #bd2929;

    }


    .delete-cancel {

        background: #aeb7c2;

        color: white;

    }

    .delete-cancel:hover {

        background: #929da9;

    }


    /* ================= RESPONSIVE ================= */

    @media(max-width: 700px) {

        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .btn-add {
            width: 100%;
        }

        .action-group {
            flex-wrap: wrap;
        }

    }

</style>

@endsection


@section('content')


<!-- ================= PAGE HEADER ================= -->

<div class="page-header">

    <div>

        <h2>
            Data Peserta Magang
        </h2>

        <p>
            Kelola data peserta magang yang sedang aktif.
        </p>

    </div>


    <a
        href="{{ route('peserta.create') }}"
        class="btn-add"
    >
        + Tambah Peserta
    </a>

</div>


<!-- ================= SUCCESS MESSAGE ================= -->

@if(session('success'))

    <div class="alert-success">

        {{ session('success') }}

    </div>

@endif


<!-- ================= TABLE ================= -->

<div class="table-panel">

    <div class="table-title">

        Daftar Peserta Aktif

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

                <th>Status</th>

                <th>Aksi</th>

            </tr>

        </thead>


        <tbody>

            @forelse($pesertas as $index => $peserta)

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

                        <span class="division">

                            {{ $peserta->divisi->nama_divisi ?? '-' }}

                        </span>

                    </td>


                    <td>

                        {{ $peserta->tanggal_mulai->format('d/m/Y') }}

                    </td>


                    <td>

                        {{ $peserta->tanggal_selesai->format('d/m/Y') }}

                    </td>


                    <td>
    @php
        $today = \Carbon\Carbon::today();
        // Sesuaikan nama variabel objek peserta di foreach kamu, misal $peserta atau $item
        $tglMulai = \Carbon\Carbon::parse($peserta->tanggal_mulai);
        $tglSelesai = \Carbon\Carbon::parse($peserta->tanggal_selesai);
    @endphp

    @if ($today->lt($tglMulai))
        <span class="status status-pending" style="background-color: #fef3c7; color: #b45309; padding: 3px 10px; border-radius: 9999px; font-weight: bold; font-size: 11px;">
            Belum Aktif
        </span>
    @elseif ($today->gte($tglMulai) && $today->lte($tglSelesai))
        <span class="status status-active">
            Aktif
        </span>
    @else
        <span class="status status-completed" style="background-color: #f1f5f9; color: #475569; padding: 3px 10px; border-radius: 9999px; font-weight: bold; font-size: 11px;">
            Selesai
        </span>
    @endif
</td>


                    <!-- AKSI -->

                    <td>

                        <div class="action-group">


                            <!-- DETAIL -->

                            <a
                                href="{{ route('peserta.show', $peserta->id) }}"
                                class="btn-action btn-detail"
                            >
                                Detail
                            </a>


                            <!-- EDIT -->

                            <a
                                href="{{ route('peserta.edit', $peserta->id) }}"
                                class="btn-action btn-edit"
                            >
                                Edit
                            </a>


                            <!-- HAPUS -->

                            <form
                                action="{{ route('peserta.destroy', $peserta->id) }}"
                                method="POST"
                                class="delete-form"
                            >

                                @csrf

                                @method('DELETE')


                                <button
                                    type="button"
                                    class="btn-action btn-delete"
                                    onclick="openDeleteModal(this)"
                                >
                                    Hapus
                                </button>

                            </form>


                        </div>

                    </td>

                </tr>


            @empty

                <tr>

                    <td
                        colspan="9"
                        class="empty"
                    >

                        <div class="empty-icon">
                            👥
                        </div>

                        Belum ada peserta magang aktif.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>


<!-- ================= DELETE MODAL ================= -->

<div
    id="deleteModal"
    class="delete-modal"
>

    <div class="delete-modal-box">


        <!-- ICON -->

        <div class="warning-icon">
            !
        </div>


        <!-- TITLE -->

        <h2>
            HAPUS PESERTA
        </h2>


        <!-- MESSAGE -->

        <p>
            Yakin ingin menghapus peserta ini?
        </p>


        <!-- BUTTON -->

        <div class="delete-actions">


            <button
                type="button"
                class="delete-confirm"
                onclick="confirmDelete()"
            >
                Ya, hapus
            </button>


            <button
                type="button"
                class="delete-cancel"
                onclick="closeDeleteModal()"
            >
                Batal
            </button>


        </div>

    </div>

</div>


<!-- ================= JAVASCRIPT ================= -->

<script>

    let deleteForm = null;


    function openDeleteModal(button) {

        deleteForm = button.closest('.delete-form');

        document
            .getElementById('deleteModal')
            .classList.add('show');

    }


    function closeDeleteModal() {

        deleteForm = null;

        document
            .getElementById('deleteModal')
            .classList.remove('show');

    }


    function confirmDelete() {

        if (deleteForm) {

            deleteForm.submit();

        }

    }


    // Klik area luar modal untuk menutup

    document
        .getElementById('deleteModal')
        .addEventListener('click', function(event) {

            if (event.target === this) {

                closeDeleteModal();

            }

        });


    // Tekan ESC untuk menutup modal

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            closeDeleteModal();

        }

    });

</script>


@endsection