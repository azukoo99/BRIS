<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'id_user',
        'tanggal_pesanan',
        'status',
        'total_harga',
        'alamat_pengiriman',
    ];

    protected $casts = [
        'tanggal_pesanan' => 'datetime',
        'total_harga' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(Pengguna::class, 'id_user');
    }

    public function items()
    {
        return $this->hasMany(ItemPesanan::class, 'id_pesanan');
    }
}
