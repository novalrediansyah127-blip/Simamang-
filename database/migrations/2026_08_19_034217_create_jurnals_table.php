<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('peserta_magang_id')
                ->constrained('peserta_magangs')
                ->cascadeOnDelete();

            $table->string('nama_file');
            $table->string('file_path');
            $table->dateTime('tanggal_upload')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurnals');
    }
};