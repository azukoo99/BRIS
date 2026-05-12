<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
        'is_active',
    ];

    public function itemPesanans()
    {
        return $this->hasMany(ItemPesanan::class, 'id_produk');
    }
}
