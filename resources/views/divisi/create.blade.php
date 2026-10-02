<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Divisi | SIMAMANG</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f8fc;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        h1 {
            color: #164b7a;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #334e68;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d9e2ec;
            border-radius: 7px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #1677e8;
        }

        .error {
            background: #fff0f0;
            color: #d93025;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            border: none;
            padding: 11px 18px;
            border-radius: 7px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-primary {
            background: #1677e8;
            color: white;
        }

        .btn-secondary {
            background: #e9eef3;
            color: #334e68;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Tambah Divisi</h1>

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('divisi.store') }}" method="POST">

        @csrf

        {{-- Kode Divisi --}}
        <div class="form-group">

            <label for="kode_divisi">
                Kode Divisi
            </label>

            <input
                type="text"
                id="kode_divisi"
                name="kode_divisi"
                value="{{ old('kode_divisi') }}"
                placeholder="Contoh: IT"
                required
            >

        </div>

        {{-- Nama Divisi --}}
        <div class="form-group">

            <label for="nama_divisi">
                Nama Divisi
            </label>

            <input
                type="text"
                id="nama_divisi"
                name="nama_divisi"
                value="{{ old('nama_divisi') }}"
                placeholder="Contoh: Teknologi Informasi"
                required
            >

        </div>

        {{-- Kapasitas --}}
        <div class="form-group">

            <label for="kapasitas">
                Kapasitas Peserta Magang
            </label>

            <input
                type="number"
                id="kapasitas"
                name="kapasitas"
                value="{{ old('kapasitas') }}"
                min="1"
                placeholder="Contoh: 20"
                required
            >

        </div>

        {{-- Tombol --}}
        <div class="buttons">

            <button
                type="submit"
                class="btn btn-primary"
            >
                Simpan Divisi
            </button>

            <a
                href="{{ route('divisi.index') }}"
                class="btn btn-secondary"
            >
                Batal
            </a>

        </div>

    </form>

</div>

</body>
</html>