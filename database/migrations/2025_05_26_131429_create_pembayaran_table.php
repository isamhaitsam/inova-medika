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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_id')->constrained('kunjungan')->onDelete('cascade');
            $table->enum('metode_pembayaran', ['cash', 'debit', 'transfer', 'qris']);
            $table->decimal('jumlah_dibayar', 10, 2);
            $table->decimal('total_tagihan', 10, 2);
            $table->decimal('kembalian', 10, 2)->default(0);
            $table->dateTime('tanggal_bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
