<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->timestamp('tanggal_pesanan')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('status')->default('diproses'); // string instead of enum to allow dibatalkan
            $table->decimal('total_harga', 10, 2)->default(0);
            $table->text('alamat_pengiriman');
            
            $table->foreign('id_user')->references('id')->on('pengguna')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
