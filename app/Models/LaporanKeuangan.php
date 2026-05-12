<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    protected $table = 'laporan_keuangan';

    protected $fillable = [
        'jenis_laporan',
        'harga',
        'deskripsi',
        'tanggal',
        'id_pesanan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}
