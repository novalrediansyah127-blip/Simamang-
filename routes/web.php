<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesertaMagangController;
use App\Http\Controllers\RiwayatMagangController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\Admin\UserController;
use Carbon\Carbon;
use App\Models\PesertaMagang;

// ======================================================
// PUBLIC
// ======================================================

// ==========================
// LOGIN
// ==========================

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);


// ==========================
// REGISTER
// ==========================

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);


// ======================================================
// MONITORING KUOTA
// PUBLIC - TANPA LOGIN
// ======================================================

Route::get('/monitoring', [MonitoringController::class, 'index'])
    ->name('monitoring.index');

Route::get('/monitoring/{divisi}', [MonitoringController::class, 'show'])
    ->name('monitoring.show');


// ======================================================
// ADMIN + PEMBIMBING
// ======================================================

Route::middleware(['auth', 'role:admin,user'])->group(function () {

    // ==========================
    // PENILAIAN JURNAL
    // ==========================

    Route::put('/jurnal/{jurnal}/nilai', [JurnalController::class, 'updateNilai'])
        ->name('jurnal.nilai');

});


// ======================================================
// ADMIN SAJA
// ======================================================

// ======================================================
// 1. AKSES UNTUK ADMIN & OPERATOR
// (Riwayat Magang & List Jurnal)
// ======================================================
Route::middleware(['auth', 'role:admin,operator'])->group(function () {

    // RIWAYAT MAGANG
    Route::get('/riwayat', [RiwayatMagangController::class, 'index'])
        ->name('riwayat.index');

    Route::get('/riwayat/export-pdf', [RiwayatMagangController::class, 'exportPdf'])
        ->name('riwayat.exportPdf');

    Route::get('/riwayat/export-excel', [RiwayatMagangController::class, 'exportExcel'])
        ->name('riwayat.exportExcel');

    // DASHBOARD OPERATOR
    Route::get('/operator/dashboard', [DashboardController::class, 'index'])
        ->name('operator.dashboard');


    // LIST JURNAL
    Route::get('/jurnal', [JurnalController::class, 'index'])
        ->name('jurnal.index');

    Route::get('/jurnal/{peserta}/upload', [JurnalController::class, 'create'])
        ->name('jurnal.create');

    Route::post('/jurnal/{peserta}', [JurnalController::class, 'store'])
        ->name('jurnal.store');

    Route::get('/jurnal/view/{jurnal}', [JurnalController::class, 'view'])
        ->name('jurnal.view');

    Route::delete('/jurnal/{jurnal}', [JurnalController::class, 'destroy'])
        ->name('jurnal.destroy');

    Route::get('/peserta/belum-aktif', function () {
    $today = Carbon::today()->format('Y-m-d');
    
    $pesertas = PesertaMagang::with('divisi')
        ->where('tanggal_mulai', '>', $today)
        ->orderBy('tanggal_mulai', 'asc')
        ->get();

    return view('admin.peserta.belum_aktif', compact('pesertas'));
})->name('peserta.belum_aktif')->middleware(['auth', 'role:admin,operator']);
});


// ======================================================
// 2. KHUSUS ADMIN SAJA
// (Dashboard, Divisi, Peserta, & Kelola Akun)
// ======================================================
Route::middleware(['auth', 'role:admin'])->group(function () {

    // DASHBOARD ADMIN
    Route::get('/admin', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // DATA DIVISI
    Route::resource('divisi', DivisiController::class);

    // DATA PESERTA MAGANG
    Route::resource('peserta', PesertaMagangController::class)
        ->parameters([
            'peserta' => 'peserta',
        ]);

    // ROUTE KELOLA AKUN OPERATOR
    Route::get('/admin/users', [AuthController::class, 'indexUser'])
        ->name('admin.users.index');
        
    Route::post('/admin/users', [AuthController::class, 'storeUser'])
        ->name('admin.users.store');

});


// ======================================================
// LOGOUT
// ======================================================

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// 🟢 TAMBAHKAN KODE INI DI BAGIAN PALING BAWAH FILE web.php:
Route::middleware(['auth', 'role:operator'])->prefix('operator')->group(function () {
    Route::get('/jurnal', [App\Http\Controllers\JurnalController::class, 'index'])->name('operator.jurnal.index');
    Route::get('/riwayat-magang', [App\Http\Controllers\RiwayatMagangController::class, 'index'])->name('operator.riwayat.index');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});