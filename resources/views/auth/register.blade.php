<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register Admin | SIMAMANG</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        .register-container {
            width: 100%;
            max-width: 1100px;
            min-height: 650px;

            display: flex;

            background: white;

            border-radius: 28px;
            overflow: hidden;

            box-shadow: 0 20px 60px rgba(0, 55, 110, 0.25);
        }


        /* =========================
           LEFT SIDE
        ========================= */

        .left-side {
            width: 50%;

            padding: 50px;

            color: white;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            background:
                linear-gradient(
                    rgba(0, 78, 150, 0.72),
                    rgba(0, 44, 90, 0.88)
                ),
                url("{{ asset('image/register.jpg') }}");

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-logo {
            width: 58px;
            height: 58px;

            object-fit: contain;

            border-radius: 8px;
        }

        .brand-name {
            font-size: 22px;
            font-weight: 700;
        }

        .brand-subtitle {
            display: block;

            font-size: 11px;

            margin-top: 2px;
        }

        .welcome h1 {
            font-size: 45px;

            margin-bottom: 10px;
        }

        .welcome h3 {
            color: #54e79a;

            margin-bottom: 18px;
        }

        .welcome p {
            max-width: 400px;

            line-height: 1.8;

            font-size: 14px;
        }

        .copyright {
            font-size: 10px;

            opacity: .8;
        }


        /* =========================
           RIGHT SIDE
        ========================= */

        .right-side {
            width: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            padding: 50px;
        }

        .register-box {
            width: 100%;

            max-width: 400px;
        }

        .register-icon {
            width: 60px;
            height: 60px;

            margin: 0 auto 15px;

            border-radius: 50%;

            background: #eef4fb;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 27px;
        }

        h2 {
            text-align: center;

            color: #17324d;

            font-size: 28px;
        }

        .subtitle {
            text-align: center;

            color: #8794a3;

            font-size: 12px;

            margin: 7px 0 25px;
        }


        /* =========================
           ERROR
        ========================= */

        .error-box {
            background: #fff0f0;

            border: 1px solid #ffcaca;

            color: #d93025;

            padding: 12px;

            border-radius: 8px;

            font-size: 12px;

            margin-bottom: 15px;
        }


        /* =========================
           FORM
        ========================= */

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;

            color: #233c56;

            font-size: 12px;

            font-weight: 600;

            margin-bottom: 7px;
        }

        input {
            width: 100%;

            height: 45px;

            padding: 0 14px;

            border: 1px solid #dbe3eb;

            border-radius: 8px;

            outline: none;

            font-size: 13px;

            color: #243b53;

            background: white;
        }

        input:focus {
            border-color: #1478e6;

            box-shadow:
                0 0 0 3px rgba(20,120,230,.1);
        }


        /* =========================
           PASSWORD
        ========================= */

        .password-wrapper {
            position: relative;

            width: 100%;
        }

        .password-wrapper input {
            padding-right: 48px;
        }

        .password-eye {
            position: absolute;

            top: 50%;
            right: 12px;

            transform: translateY(-50%);

            width: 30px;
            height: 30px;

            border: none;

            background: transparent;

            padding: 0;
            margin: 0;

            cursor: pointer;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 16px;

            color: #718096;
        }

        .password-eye:hover {
            color: #1769aa;
        }


        /* =========================
           BUTTON
        ========================= */

        .register-button {
            width: 100%;

            height: 47px;

            border: none;

            border-radius: 7px;

            background: #1478e6;

            color: white;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            margin-top: 8px;
        }

        .register-button:hover {
            background: #0e67c9;
        }


        /* =========================
           LOGIN LINK
        ========================= */

        .login-link {
            text-align: center;

            margin-top: 22px;

            color: #788797;

            font-size: 12px;
        }

        .login-link a {
            color: #1478e6;

            text-decoration: none;

            font-weight: 600;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 850px) {

            .register-container {
                max-width: 500px;
            }

            .left-side {
                display: none;
            }

            .right-side {
                width: 100%;
            }

        }

    </style>

</head>


<body>


<div class="register-container">


    <!-- =========================
         LEFT SIDE
    ========================== -->

    <div class="left-side">


        <div class="brand">

            <img
                src="{{ asset('image/pln.png') }}"
                alt="Logo PLN"
                class="brand-logo"
            >

            <div>

                <div class="brand-name">
                    SIMAMANG
                </div>

                <span class="brand-subtitle">
                    Sistem Informasi Magang PLN
                </span>

            </div>

        </div>


        <div class="welcome">

            <h1>
                Buat Akun
            </h1>

            <h3>
                Admin SIMAMANG
            </h3>

            <p>
                Daftarkan akun administrator untuk
                mengelola data peserta magang, divisi,
                dan riwayat magang pada sistem SIMAMANG.
            </p>

        </div>


        <div class="copyright">

            © 2026 SIMAMANG - Sistem Informasi Magang PLN (Persero)

        </div>


    </div>



    <!-- =========================
         RIGHT SIDE
    ========================== -->

    <div class="right-side">


        <div class="register-box">


            <div class="register-icon">
                👤
            </div>


            <h2>
                Register Admin
            </h2>


            <p class="subtitle">
                Buat akun untuk mengakses sistem
            </p>


            @if ($errors->any())

                <div class="error-box">

                    @foreach ($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif



            <!-- FORM -->

            <form
                action="{{ route('register') }}"
                method="POST"
            >

                @csrf


                <!-- NAMA -->

                <div class="form-group">

                    <label>
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        required
                    >

                </div>



                <!-- EMAIL -->

                <div class="form-group">

                    <label>
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email"
                        required
                    >

                </div>



                <!-- PASSWORD -->

                <div class="form-group">

                    <label>
                        Password
                    </label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Masukkan password"
                            required
                        >

                        <button
                            type="button"
                            class="password-eye"
                            onclick="togglePassword('password', this)"
                        >
                            👁
                        </button>

                    </div>

                </div>



                <!-- KONFIRMASI PASSWORD -->

                <div class="form-group">

                    <label>
                        Konfirmasi Password
                    </label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            placeholder="Ulangi password"
                            required
                        >

                        <button
                            type="button"
                            class="password-eye"
                            onclick="togglePassword('password_confirmation', this)"
                        >
                            👁
                        </button>

                    </div>

                </div>



                <!-- BUTTON -->

                <button
                    type="submit"
                    class="register-button"
                >
                    👤 &nbsp; Buat Akun
                </button>


            </form>



            <!-- LOGIN -->

            <div class="login-link">

                Sudah punya akun?

                <a href="{{ route('login') }}">
                    Login di sini
                </a>

            </div>


        </div>

    </div>

</div>



<script>

function togglePassword(inputId, button) {

    const input = document.getElementById(inputId);

    if (input.type === 'password') {

        input.type = 'text';

    } else {

        input.type = 'password';

        button.textContent = '👁';

    }

}

</script>


</body>

</html>