<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Riwayat Magang SIMAMANG</title>

    <style>

        @page {
            margin: 25px 20px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            color: #222;
        }


        /* ================= HEADER ================= */

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 4px 0;
            font-size: 10px;
        }

        .header h2 {
            margin: 12px 0 0;
            font-size: 15px;
        }


        /* ================= TABLE ================= */

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th {
            background: #164b7a;
            color: white;
            padding: 6px 4px;
            border: 1px solid #ccc;
            text-align: center;
            font-size: 8px;
        }

        td {
            padding: 6px 4px;
            border: 1px solid #ccc;
            font-size: 8px;
            vertical-align: middle;
            word-wrap: break-word;
        }


        /* ================= COLUMN WIDTH ================= */

        th:nth-child(1),
        td:nth-child(1) {
            width: 4%;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 12%;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 14%;
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 12%;
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 12%;
        }

        th:nth-child(6),
        td:nth-child(6) {
            width: 9%;
        }

        th:nth-child(7),
        td:nth-child(7) {
            width: 9%;
        }

        th:nth-child(8),
        td:nth-child(8) {
            width: 7%;
        }

        th:nth-child(9),
        td:nth-child(9) {
            width: 13%;
        }

        th:nth-child(10),
        td:nth-child(10) {
            width: 8%;
        }


        /* ================= TEXT ================= */

        .center {
            text-align: center;
        }

        .status-selesai {
            color: #11955b;
            font-weight: bold;
        }

        .status-belum {
            color: #d93636;
            font-weight: bold;
        }

        .nilai {
            text-align: center;
            font-weight: bold;
        }


        /* ================= FOOTER ================= */

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 8px;
        }

    </style>

</head>


<body>


    <!-- ================= HEADER ================= -->

    <div class="header">

        <h1>
            SIMAMANG
        </h1>

        <p>
            Sistem Informasi Magang PLN
        </p>

        <h2>
            RIWAYAT PESERTA MAGANG
        </h2>

    </div>


    <!-- ================= TABLE ================= -->

    <table>

        <thead>

            <tr>

                <th>No</th>

                <th>Nama Peserta</th>

                <th>Asal Instansi</th>

                <th>Jurusan</th>

                <th>Divisi</th>

                <th>Tanggal Mulai</th>

                <th>Tanggal Selesai</th>

                <th>Status Magang</th>

                <th>Status Jurnal</th>

                <th>Nilai</th>

            </tr>

        </thead>


        <tbody>

            @forelse($riwayats as $index => $peserta)

                <tr>


                    <!-- NO -->

                    <td class="center">
                        {{ $index + 1 }}
                    </td>


                    <!-- NAMA -->

                    <td>
                        {{ $peserta->nama }}
                    </td>


                    <!-- ASAL INSTANSI -->

                    <td>
                        {{ $peserta->asal_instansi }}
                    </td>


                    <!-- JURUSAN -->

                    <td>
                        {{ $peserta->jurusan }}
                    </td>


                    <!-- DIVISI -->

                    <td>
                        {{ $peserta->divisi->nama_divisi ?? '-' }}
                    </td>


                    <!-- TANGGAL MULAI -->

                    <td class="center">

                        {{ $peserta->tanggal_mulai
                            ? $peserta->tanggal_mulai->format('d/m/Y')
                            : '-' }}

                    </td>


                    <!-- TANGGAL SELESAI -->

                    <td class="center">

                        {{ $peserta->tanggal_selesai
                            ? $peserta->tanggal_selesai->format('d/m/Y')
                            : '-' }}

                    </td>


                    <!-- STATUS MAGANG -->

                    <td class="center">

                        <span class="status-selesai">
                            Selesai
                        </span>

                    </td>


                    <!-- STATUS JURNAL -->

                    <td class="center">

                        @if($peserta->jurnal)

                            <span class="status-selesai">
                                Sudah Dikumpulkan
                            </span>

                        @else

                            <span class="status-belum">
                                Belum Selesai
                            </span>

                        @endif

                    </td>


                    <!-- NILAI -->

                    <td class="nilai">

                        @if(
                            $peserta->jurnal &&
                            $peserta->jurnal->nilai !== null
                        )

                            {{ $peserta->jurnal->nilai }}

                        @else

                            -

                        @endif

                    </td>


                </tr>


            @empty

                <tr>

                    <td
                        colspan="10"
                        class="center"
                    >

                        Belum ada riwayat peserta magang.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    <!-- ================= FOOTER ================= -->

    <div class="footer">

        Dicetak dari Sistem Informasi Magang PLN (SIMAMANG)

    </div>


</body>

</html>