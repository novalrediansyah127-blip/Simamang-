<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peserta_magangs', function (Blueprint $table) {
            $table->string('foto_surat_balasan')->nullable()->after('status');
            $table->string('foto_formal')->nullable()->after('foto_surat_balasan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peserta_magangs', function (Blueprint $table) {
            $table->dropColumn([
                'foto_surat_balasan',
                'foto_formal',
            ]);
        });
    }
};