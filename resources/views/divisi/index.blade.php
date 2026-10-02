@extends('layouts.admin')

@section('title', 'Data Divisi')

@section('page-title')

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


    /* ================= BUTTON TAMBAH ================= */

    .btn-add {
        display: inline-flex;
        align-items: center;
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


    /* ================= SUCCESS ================= */

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


    .division-name {
        font-weight: bold;

        color: #243b53;
    }


    /* ================= KAPASITAS ================= */

    .capacity {
        display: inline-block;

        padding: 6px 10px;

        background: #e8f3ff;

        color: #1769aa;

        border-radius: 6px;

        font-size: 12px;

        font-weight: bold;
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

        padding: 7px 10px;

        border-radius: 6px;

        text-decoration: none;

        border: none;

        cursor: pointer;

        font-size: 12px;

        font-weight: bold;
    }


    .btn-edit {
        background: #fff3df;

        color: #c47d00;
    }


    .btn-edit:hover {
        background: #ffe8c2;
    }


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

        max-width: 90%;

        background: white;

        border-radius: 12px;

        padding: 30px;

        text-align: center;

        box-shadow:
            0 10px 35px rgba(0,0,0,.2);

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


    .warning-icon {

        width: 65px;

        height: 65px;

        margin: 0 auto 15px;

        border: 3px solid #f5b942;

        border-radius: 50%;

        color: #f5b942;

        font-size: 42px;

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


    .delete-actions {

        display: flex;

        justify-content: center;

        gap: 10px;
    }


    .delete-actions button {

        border: none;

        padding: 10px 22px;

        border-radius: 6px;

        font-size: 13px;

        font-weight: bold;

        cursor: pointer;
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

</style>
@endsection


@section('content')

<!-- ================= HEADER ================= -->

<div class="page-header">

    <div>

        <h2>
            Data Divisi Magang
        </h2>

        <p>
            Kelola data divisi dan kapasitas peserta magang.
        </p>

    </div>


    <a
        href="{{ route('divisi.create') }}"
        class="btn-add"
    >
        + Tambah Divisi
    </a>

</div>


<!-- ================= SUCCESS ================= -->

@if(session('success'))

    <div class="alert-success">

        {{ session('success') }}

    </div>

@endif


<!-- ================= TABLE ================= -->

<div class="table-panel">

    <div class="table-title">

        Daftar Divisi

    </div>


    <table class="data-table">

        <thead>

            <tr>

                <th>No</th>

                <th>Nama Divisi</th>

                <th>Kapasitas</th>

                <th>Aksi</th>

            </tr>

        </thead>


        <tbody>

            @forelse($divisis as $divisi)

                <tr>


                    <td class="number">

                        {{ $loop->iteration }}

                    </td>


                    <td class="division-name">

                        {{ $divisi->nama_divisi }}

                    </td>


                    <td>

                        <span class="capacity">

                            {{ $divisi->kapasitas }} orang

                        </span>

                    </td>


                    <td>

                        <div class="action-group">


                            <!-- EDIT -->

                            <a
                                href="{{ route('divisi.edit', $divisi->id) }}"
                                class="btn-action btn-edit"
                            >
                                Edit
                            </a>


                            <!-- DELETE -->

                            <form
                                action="{{ route('divisi.destroy', $divisi->id) }}"
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
                        colspan="4"
                        class="empty"
                    >

                        <div class="empty-icon">
                            🏢
                        </div>

                        Belum ada data divisi.

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


        <div class="warning-icon">
            !
        </div>


        <h2>
            HAPUS DIVISI
        </h2>


        <p>
            Yakin ingin menghapus divisi ini?
        </p>


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


document
    .getElementById('deleteModal')
    .addEventListener('click', function(event) {

        if (event.target === this) {

            closeDeleteModal();

        }

    });


document.addEventListener('keydown', function(event) {

    if (event.key === 'Escape') {

        closeDeleteModal();

    }

});

</script>

@endsection