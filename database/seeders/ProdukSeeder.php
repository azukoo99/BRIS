<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produk')->insert([
            [
                'nama' => 'Benih Cabai Rawit Unggul 50gr',
                'deskripsi' => 'Tahan penyakit, cocok untuk dataran rendah dan tinggi',
                'harga' => 35000.00,
                'stok' => 100,
                'gambar' => 'images/cabai.png',
                'is_active' => 'yes'
            ],
            [
                'nama' => 'Benih Tomat Cherry 25gr',
                'deskripsi' => 'Tomat kecil manis, cocok untuk hidroponik dan pot',
                'harga' => 28000.00,
                'stok' => 80,
                'gambar' => 'images/tomat.png',
                'is_active' => 'yes'
            ],
            [
                'nama' => 'Benih Kangkung Darat 100gr',
                'deskripsi' => 'Cepat panen, cocok untuk pemula',
                'harga' => 15000.00,
                'stok' => 150,
                'gambar' => 'images/kangkung.png',
                'is_active' => 'yes'
            ],
            [
                'nama' => 'Benih Bayam Hijau 100gr',
                'deskripsi' => 'Pertumbuhan cepat, kaya nutrisi',
                'harga' => 14000.00,
                'stok' => 140,
                'gambar' => 'images/bayam.png',
                'is_active' => 'yes'
            ],
            [
                'nama' => 'Benih Jagung Manis 250gr',
                'deskripsi' => 'Rasa manis legit, hasil panen tinggi',
                'harga' => 45000.00,
                'stok' => 90,
                'gambar' => 'images/jagung.png',
                'is_active' => 'yes'
            ],
            [
                'nama' => 'Benih Terong Ungu 50gr',
                'deskripsi' => 'Buah besar, tahan hama dan penyakit',
                'harga' => 30000.00,
                'stok' => 70,
                'gambar' => 'images/terong.png',
                'is_active' => 'yes'
            ]
        ]);
    }
}
