<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin | SIMAMANG</title>

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

        /* =========================================
           CONTAINER
        ========================================= */

        .login-container {
            width: 100%;
            max-width: 1250px;
            min-height: 700px;

            display: flex;

            background: white;

            border-radius: 28px;

            overflow: hidden;

            box-shadow:
                0 20px 60px rgba(0, 55, 110, 0.25);
        }


        /* =========================================
           SUCCESS MESSAGE
        ========================================= */

        .success-box {
            background: #ecfdf3;
            border: 1px solid #b7ebc9;
            color: #16803c;

            padding: 12px;

            border-radius: 8px;

            font-size: 12px;

            margin-bottom: 15px;
        }


        /* =========================================
           BAGIAN KIRI
        ========================================= */

        .left-side {
            width: 55%;

            position: relative;

            padding: 45px 55px;

            color: white;

            overflow: hidden;

            display: flex;

            flex-direction: column;

            justify-content: space-between;

            background:
                linear-gradient(
                    rgba(0, 78, 150, 0.72),
                    rgba(0, 44, 90, 0.88)
                ),
                url("{{ asset('image/gedung.jpg') }}");

            background-size: cover;

            background-position: center;

            background-repeat: no-repeat;
        }


        /* =========================================
           BRAND
        ========================================= */

        .brand {
            display: flex;

            align-items: center;

            gap: 12px;

            position: relative;

            z-index: 2;
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

            opacity: 0.9;
        }


        /* =========================================
           WELCOME
        ========================================= */

        .welcome-content {
            position: relative;

            z-index: 2;

            max-width: 520px;
        }

        .welcome-small {
            font-size: 17px;

            margin-bottom: 5px;
        }

        .welcome-title {
            font-size: 52px;

            line-height: 1;

            font-weight: 800;

            margin-bottom: 10px;
        }

        .welcome-green {
            color: #54e79a;

            font-size: 19px;

            font-weight: 600;

            margin-bottom: 20px;
        }

        .welcome-description {
            font-size: 15px;

            line-height: 1.8;

            max-width: 450px;

            opacity: 0.95;
        }


        /* =========================================
           MONITORING BUTTON
        ========================================= */

        .monitoring-button {
            display: block;

            width: 100%;

            text-decoration: none;

            color: inherit;

            position: relative;

            z-index: 2;
        }

        .monitoring-feature {
            width: 100%;

            padding: 22px 20px;

            background: rgba(255, 255, 255, 0.90);

            color: #17324d;

            border-radius: 16px;

            text-align: center;

            box-shadow:
                0 8px 25px rgba(0, 0, 0, 0.15);

            cursor: pointer;

            transition: 0.25s;
        }

        .monitoring-feature:hover {
            transform: translateY(-5px);

            background: rgba(255, 255, 255, 0.97);

            box-shadow:
                0 14px 30px rgba(0, 0, 0, 0.22);
        }

        .monitoring-feature:active {
            transform: translateY(-2px);
        }

        .monitoring-icon {
            width: 46px;
            height: 46px;

            margin: 0 auto 10px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #1976d2;

            color: white;

            font-size: 21px;
        }

        .monitoring-title {
            display: block;

            color: #1478e6;

            font-size: 15px;

            font-weight: 700;

            margin-bottom: 5px;
        }

        .monitoring-text {
            display: block;

            color: #66788a;

            font-size: 11px;

            line-height: 1.5;
        }


        /* =========================================
           COPYRIGHT
        ========================================= */

        .copyright {
            position: relative;

            z-index: 2;

            font-size: 10px;

            opacity: 0.8;
        }


        /* =========================================
           BAGIAN KANAN
        ========================================= */

        .right-side {
            width: 45%;

            background: #ffffff;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 45px;
        }

        .login-box {
            width: 100%;

            max-width: 430px;
        }


        /* =========================================
           LOGIN TITLE
        ========================================= */

        .login-title {
            text-align: center;

            font-size: 28px;

            color: #17324d;

            font-weight: 700;

            margin-bottom: 5px;
        }

        .login-subtitle {
            text-align: center;

            color: #8794a3;

            font-size: 12px;

            margin-bottom: 30px;
        }


        /* =========================================
           ERROR
        ========================================= */

        .error-box {
            background: #fff0f0;

            border: 1px solid #ffcaca;

            color: #d93025;

            padding: 12px;

            border-radius: 9px;

            font-size: 12px;

            margin-bottom: 18px;
        }


        /* =========================================
           FORM
        ========================================= */

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;

            color: #233c56;

            font-size: 12px;

            font-weight: 600;

            margin-bottom: 7px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;

            left: 15px;

            top: 50%;

            transform: translateY(-50%);

            color: #8493a3;

            font-size: 15px;
        }

        .form-input {
            width: 100%;

            height: 47px;

            padding: 0 42px;

            border: 1px solid #dbe3eb;

            border-radius: 8px;

            outline: none;

            font-size: 13px;

            color: #233c56;

            transition: 0.2s;
        }

        .form-input:focus {
            border-color: #1478e6;

            box-shadow:
                0 0 0 3px rgba(20, 120, 230, 0.10);
        }

        .form-input::placeholder {
            color: #a4afb9;
        }


        /* =========================================
           PASSWORD
        ========================================= */

        .password-eye {
            position: absolute;

            right: 15px;

            top: 50%;

            transform: translateY(-50%);

            border: none;

            background: none;

            cursor: pointer;

            color: #7d8c9b;

            font-size: 14px;
        }


        /* =========================================
           OPTIONS
        ========================================= */

        .login-options {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin: 5px 0 20px;

            font-size: 11px;
        }

        .remember {
            display: flex;

            align-items: center;

            gap: 7px;

            color: #455b70;

            cursor: pointer;
        }

        .remember input {
            width: 15px;
            height: 15px;
        }

        .forgot {
            color: #1478e6;

            text-decoration: none;

            font-weight: 600;
        }


        /* =========================================
           LOGIN BUTTON
        ========================================= */

        .login-button {
            width: 100%;

            height: 47px;

            border: none;

            border-radius: 7px;

            background: #1478e6;

            color: white;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            transition: 0.2s;

            box-shadow:
                0 5px 14px rgba(20, 120, 230, 0.25);
        }

        .login-button:hover {
            background: #0e67c9;

            transform: translateY(-1px);
        }


        /* =========================================
           DIVIDER
        ========================================= */

        .divider {
            display: flex;

            align-items: center;

            gap: 12px;

            margin: 22px 0;
        }

        .divider::before,
        .divider::after {
            content: "";

            flex: 1;

            height: 1px;

            background: #e1e6eb;
        }

        .divider span {
            font-size: 11px;

            color: #8995a1;
        }


        /* =========================================
           REGISTER
        ========================================= */

        .contact {
            text-align: center;

            margin-top: 25px;

            color: #788797;

            font-size: 11px;
        }

        .contact a {
            color: #1478e6;

            text-decoration: none;

            font-weight: 600;
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 900px) {

            .login-container {
                max-width: 500px;
            }

            .left-side {
                display: none;
            }

            .right-side {
                width: 100%;
            }
        }

        @media (max-width: 500px) {

            body {
                padding: 10px;
            }

            .right-side {
                padding: 30px 22px;
            }

            .login-container {
                border-radius: 18px;
            }
        }

    </style>
</head>


<body>

<div class="login-container">


    <!-- =================================
         BAGIAN KIRI
    ================================== -->

    <div class="left-side">


        <!-- BRAND -->

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
                    Sistem Informasi Manajemen Magang PLN
                </span>

            </div>

        </div>


        <!-- WELCOME -->

        <div class="welcome-content">

            <div class="welcome-small">
                Selamat Datang di
            </div>

            <div class="welcome-title">
                SIMAMANG
            </div>

            <div class="welcome-green">
                Sistem Informasi Manajemen Magang PLN
            </div>

            <p class="welcome-description">
                Kelola data peserta magang, divisi,
                kuota, dan riwayat magang dengan
                lebih mudah, terstruktur, dan
                terintegrasi.
            </p>

        </div>


        <!-- =================================
             TOMBOL MONITORING
        ================================== -->

        <a
            href="{{ route('monitoring.index') }}"
            class="monitoring-button"
            title="Lihat Monitoring Kuota"
        >

            <div class="monitoring-feature">

                <div class="monitoring-icon">
                    📊
                </div>

                <span class="monitoring-title">
                    Monitoring Kuota
                </span>

                <span class="monitoring-text">
                    Pantau kuota magang tanpa login
                </span>

            </div>

        </a>


        <!-- COPYRIGHT -->

        <div class="copyright">

            © 2026 SIMAMANG - Sistem Informasi Magang PLN (Persero)

        </div>


    </div>


    <!-- =================================
         BAGIAN KANAN
    ================================== -->

    <div class="right-side">

        <div class="login-box">


            <h1 class="login-title">
                Login Admin
            </h1>


            <p class="login-subtitle">
                Masuk untuk mengelola sistem
            </p>


            <!-- SUCCESS -->

            @if (session('success'))

                <div class="success-box">
                    {{ session('success') }}
                </div>

            @endif


            <!-- ERROR -->

            @if ($errors->any())

                <div class="error-box">
                    {{ $errors->first() }}
                </div>

            @endif


            <!-- FORM LOGIN -->

            <form
                action="{{ route('login') }}"
                method="POST"
            >

                @csrf


                <!-- EMAIL -->

                <div class="form-group">

                    <label class="form-label">
                        Email
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            ✉
                        </span>

                        <input
                            type="email"
                            name="email"
                            class="form-input"
                            placeholder="Masukkan email"
                            value="{{ old('email') }}"
                            required
                        >

                    </div>

                </div>


                <!-- PASSWORD -->

                <div class="form-group">

                    <label class="form-label">
                        Password
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            🔒
                        </span>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-input"
                            placeholder="Masukkan password"
                            required
                        >

                        <button
                            type="button"
                            class="password-eye"
                            onclick="togglePassword()"
                        >
                            👁
                        </button>

                    </div>

                </div>


                <!-- OPTIONS -->

                <div class="login-options">

                    <label class="remember">

                        <input
                            type="checkbox"
                            name="remember"
                        >

                        Ingat saya

                    </label>


                    <a
                        href="#"
                        class="forgot"
                    >
                        Lupa password?
                    </a>

                </div>


                <!-- LOGIN BUTTON -->

                <button
                    type="submit"
                    class="login-button"
                >
                    🔐 &nbsp; Masuk
                </button>

            </form>

        

        </div>

    </div>


</div>


<script>

function togglePassword() {

    const password =
        document.getElementById("password");

    if (password.type === "password") {

        password.type = "text";

    } else {

        password.type = "password";

    }

}

</script>

</body>

</html>