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
        Schema::create('laporan_keuangan', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_laporan', ['pemasukan', 'pengeluaran']);
            $table->decimal('harga', 10, 2);
            $table->text('deskripsi')->nullable();
            $table->date('tanggal');
            $table->unsignedBigInteger('id_pesanan')->nullable();
            
            $table->foreign('id_pesanan')->references('id')->on('pesanan')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_keuangan');
    }
};
