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
        Schema::dropIfExists('kunjungan_obat');
        Schema::dropIfExists('kunjungan_tindakan');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('kunjungan_obat', function (Blueprint $table) {
            $table->id();
            // Tambahkan kolom lain sesuai kebutuhan sebelumnya
            $table->timestamps();
        });

        Schema::create('kunjungan_tindakan', function (Blueprint $table) {
            $table->id();
            // Tambahkan kolom lain sesuai kebutuhan sebelumnya
            $table->timestamps();
        });
    }
};
