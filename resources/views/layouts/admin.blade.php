<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Dashboard') - SIMAMANG
    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f8fc;
            color: #243b53;
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;

            width: 250px;

            background: linear-gradient(
                180deg,
                #07579c 0%,
                #063f78 100%
            );

            color: white;
            padding: 20px 14px;

            z-index: 100;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;

            padding: 6px 9px 20px;

            border-bottom: 1px solid rgba(255,255,255,.18);
        }

        .brand img {
            width: 44px;
            height: 44px;

            object-fit: contain;

            background: white;
            border-radius: 8px;
            padding: 3px;
        }

        .brand-name {
            font-size: 18px;
            font-weight: bold;
        }

        .brand-subtitle {
            font-size: 10px;
            color: #c9e2f8;
            margin-top: 4px;
        }

        .section-title {
            font-size: 11px;
            color: #b7d3ea;

            margin: 25px 9px 10px;

            text-transform: uppercase;
            letter-spacing: .6px;
            font-weight: bold;
        }

        .nav-item {
            display: flex;
            align-items: center;

            gap: 12px;

            padding: 12px 12px;

            margin-bottom: 5px;

            color: #e7f3ff;
            text-decoration: none;

            border-radius: 7px;

            font-size: 14px;

            transition: .2s;
        }

        .nav-item:hover {
            background: rgba(255,255,255,.12);
        }

        .nav-item.active {
            background: rgba(255,255,255,.18);

            box-shadow:
                inset 3px 0 0 white;
        }

        .nav-icon {
            width: 20px;
            text-align: center;
            font-size: 15px;
        }

        /* ================= LOGOUT ================= */

        .logout-area {
            position: absolute;

            left: 14px;
            right: 14px;
            bottom: 22px;
        }

        .logout-button {
            width: 100%;

            border: none;
            background: transparent;

            color: #e7f3ff;

            padding: 12px;

            text-align: left;

            border-radius: 7px;

            cursor: pointer;

            font-size: 14px;
        }

        .logout-button:hover {
            background: rgba(255,255,255,.12);
        }

        /* ================= LOGIN BUTTON ================= */

        .login-button {
            display: flex;
            align-items: center;
            gap: 10px;

            width: 100%;

            padding: 12px;

            color: #e7f3ff;

            text-decoration: none;

            border-radius: 7px;

            font-size: 14px;

            transition: .2s;
        }

        .login-button:hover {
            background: rgba(255,255,255,.12);
        }

        /* ================= MAIN ================= */

        .main-wrapper {
            margin-left: 250px;
            min-height: 100vh;
        }

        /* ================= TOPBAR ================= */

        .topbar {
            height: 72px;

            background: white;

            border-bottom: 1px solid #e6edf3;

            display: flex;

            justify-content: space-between;
            align-items: center;

            padding: 0 32px;
        }

        .page-title {
            font-size: 21px;

            font-weight: bold;

            color: #243b53;
        }

        .user-area {
            display: flex;

            align-items: center;

            gap: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;

            border-radius: 50%;

            background: #e5edf5;

            display: flex;

            align-items: center;
            justify-content: center;

            font-weight: bold;

            font-size: 16px;

            color: #1769aa;
        }

        .user-name {
            font-size: 13px;
            font-weight: bold;
        }

        .user-role {
            font-size: 11px;

            color: #8795a1;

            margin-top: 3px;
        }

        /* ================= CONTENT ================= */

        .content {
            padding: 30px 32px 35px;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width: 900px) {

            .sidebar {
                width: 215px;
            }

            .main-wrapper {
                margin-left: 215px;
            }

            .content {
                padding: 25px;
            }

        }

        @media(max-width: 700px) {

            .sidebar {
                position: relative;

                width: 100%;

                min-height: auto;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .logout-area {
                position: relative;

                left: auto;
                right: auto;
                bottom: auto;

                margin-top: 20px;
            }

        }

    </style>

    @yield('styles')

</head>


<body>


    <!-- =========================
         SIDEBAR
    ========================== -->

    <aside class="sidebar">


        <!-- BRAND -->

        <div class="brand">

            <img
                src="{{ asset('image/pln.png') }}"
                alt="Logo PLN"
            >

            <div>

                <div class="brand-name">
                    SIMAMANG
                </div>

                <div class="brand-subtitle">
                    Sistem Informasi Manajemen Magang PLN
                </div>

            </div>

        </div>


        <!-- MENU TITLE -->

        <div class="section-title">
            Menu Utama
        </div>


{{-- =================================================
             MENU UNTUK OPERATOR
             HANYA MENAMPILKAN LIST JURNAL DAN RIWAYAT MAGANG
        ================================================== --}}
        @if(Auth::check() && Auth::user()->role === 'operator')

<!-- DASHBOARD OPERATOR -->
<a 
    href="{{ route('operator.dashboard') }}" 
    class="nav-item {{ request()->routeIs('operator.dashboard') ? 'active' : '' }}"
>
    <span class="nav-icon">▤</span>
    Dashboard
</a>
        
        
        <!-- LIST JURNAL -->
            <a
                href="{{ route('jurnal.index') }}"
                class="nav-item {{ request()->is('jurnal*') ? 'active' : '' }}"
            >
                <span class="nav-icon">▤</span>
                List Jurnal
            </a>

            <!-- RIWAYAT MAGANG -->
            <a
                href="{{ route('riwayat.index') }}"
                class="nav-item {{ request()->routeIs('riwayat.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">▤</span>
                Riwayat Magang
            </a>

        {{-- =================================================
             MENU UNTUK ADMIN
        ================================================== --}}
        @elseif(Auth::check() && Auth::user()->role === 'admin')

            <!-- DASHBOARD -->
           <a
             href="{{ route('operator.dashboard') }}"
             class="nav-item {{ request()->is('operator/dashboard*') ? 'active' : '' }}"
             >
             <span class="nav-icon">▤</span>
              Dashboard
        </a>

            <!-- MONITORING (PUBLIC / ADMIN) -->
            <a
                href="{{ route('monitoring.index') }}"
                class="nav-item {{ request()->routeIs('monitoring.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">◉</span>
                Monitoring Kuota
            </a>

            <!-- DATA PESERTA -->
            <a
                href="{{ route('peserta.index') }}"
                class="nav-item {{ request()->is('peserta*') ? 'active' : '' }}"
            >
                <span class="nav-icon">♙</span>
                Data Peserta
            </a>

            <!-- LIST JURNAL -->
            <a
                href="{{ route('jurnal.index') }}"
                class="nav-item {{ request()->is('jurnal*') ? 'active' : '' }}"
            >
                <span class="nav-icon">▤</span>
                List Jurnal
            </a>

            <!-- DATA DIVISI -->
            <a
                href="{{ route('divisi.index') }}"
                class="nav-item {{ request()->is('divisi*') ? 'active' : '' }}"
            >
                <span class="nav-icon">▣</span>
                Data Divisi
            </a>

            <!-- RIWAYAT MAGANG -->
            <a
                href="{{ route('riwayat.index') }}"
                class="nav-item {{ request()->routeIs('riwayat.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">▤</span>
                Riwayat Magang
            </a>

        {{-- =================================================
             MENU UNTUK PUBLIC / USER BIASA (BELUM LOGIN / USER)
        ================================================== --}}
        @else

            <!-- MONITORING -->
            <a
                href="{{ route('monitoring.index') }}"
                class="nav-item {{ request()->routeIs('monitoring.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">◉</span>
                Monitoring Kuota
            </a>

        @endif


        <!-- =========================
             BAGIAN BAWAH SIDEBAR
        ========================== -->
        

        {{-- KODE BARU --}}
<div class="logout-area">

    <!-- =========================================
         BAGIAN BAWAH SIDEBAR (USER / LOGOUT)
    ========================================= -->
    @if(Auth::check())

        <div class="logout-area">

            {{-- TOMBOL TAMBAH OPERATOR (KHUSUS ADMIN) --}}
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.users.index') }}" 
                   class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                   style="margin-bottom: 12px; display: flex; align-items: center; text-decoration: none;">
                    <span class="nav-icon">👤</span>
                    <span>Manajemen User</span>
                </a>
            @endif

            {{-- TOMBOL LOGOUT --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">
                    🚪 &nbsp; Logout
                </button>
            </form>

        </div>

    @else

        {{-- USER BELUM LOGIN --}}
        <div class="logout-area">
            <a href="{{ route('login') }}" class="login-button">
                🔐 &nbsp; Login Admin
            </a>
        </div>

    @endif

</aside>



    <!-- =========================
         MAIN
    ========================== -->

    <div class="main-wrapper">


        <!-- TOPBAR -->

        <header class="topbar">


            <div class="page-title">

                @yield('page-title')

            </div>


            <!-- =========================
                 USER AREA
            ========================== -->

            @if(Auth::check())

                {{-- KALAU SUDAH LOGIN --}}

                <div class="user-area">

                    <div class="avatar">

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                    </div>


                    <div>

                        <div class="user-name">

                            {{ Auth::user()->name }}

                        </div>

                    </div>

                </div>

            @else

                {{-- KALAU BELUM LOGIN --}}

                <div class="user-area">

                    <div class="avatar">
                        P
                    </div>

                    <div>

                        <div class="user-name">
                            Pengunjung
                        </div>

                        <div class="user-role">
                            Monitoring Publik
                        </div>

                    </div>

                </div>

            @endif


        </header>



        <!-- =========================
             CONTENT
        ========================== -->

        <main class="content">

            @yield('content')

        </main>


    </div>


</body>

</html>