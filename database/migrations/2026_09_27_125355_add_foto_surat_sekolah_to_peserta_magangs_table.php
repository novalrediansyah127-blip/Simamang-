<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peserta_magangs', function (Blueprint $table) {
            // Menambahkan kolom foto_surat_sekolah setelah foto_surat_balasan
            $table->string('foto_surat_sekolah')->nullable()->after('foto_surat_balasan');
        });
    }

    public function down(): void
    {
        Schema::table('peserta_magangs', function (Blueprint $table) {
            $table->dropColumn('foto_surat_sekolah');
        });
    }
};