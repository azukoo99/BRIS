<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesanan;
use App\Models\ItemPesanan;
use App\Models\Pengguna;
use App\Models\Produk;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelanggan = Pengguna::where('role', 'pelanggan')->first();
        $produks = Produk::take(2)->get();

        if ($pelanggan && $produks->count() >= 2) {
            // Pesanan 1 (Diproses)
            $pesanan1 = Pesanan::create([
                'id_user' => $pelanggan->id,
                'status' => 'diproses',
                'total_harga' => ($produks[0]->harga * 2) + ($produks[1]->harga * 1),
                'alamat_pengiriman' => 'Jl. Merdeka No. 10, Jakarta Pusat',
            ]);

            ItemPesanan::create([
                'id_pesanan' => $pesanan1->id,
                'id_produk' => $produks[0]->id,
                'jumlah' => 2,
                'harga_produk' => $produks[0]->harga,
                'subtotal' => $produks[0]->harga * 2,
            ]);

            ItemPesanan::create([
                'id_pesanan' => $pesanan1->id,
                'id_produk' => $produks[1]->id,
                'jumlah' => 1,
                'harga_produk' => $produks[1]->harga,
                'subtotal' => $produks[1]->harga * 1,
            ]);

            // Pesanan 2 (Selesai)
            $pesanan2 = Pesanan::create([
                'id_user' => $pelanggan->id,
                'status' => 'selesai',
                'total_harga' => ($produks[1]->harga * 3),
                'alamat_pengiriman' => 'Jl. Sudirman No. 45, Jakarta Selatan',
            ]);

            ItemPesanan::create([
                'id_pesanan' => $pesanan2->id,
                'id_produk' => $produks[1]->id,
                'jumlah' => 3,
                'harga_produk' => $produks[1]->harga,
                'subtotal' => $produks[1]->harga * 3,
            ]);
        }
    }
}
