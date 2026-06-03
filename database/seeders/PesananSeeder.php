<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesanan;
use App\Models\ItemPesanan;
use App\Models\Pengguna;
use App\Models\Produk;
use App\Models\LaporanKeuangan;
use Carbon\Carbon;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Pengguna::where('role', 'admin')->first();
        $pelanggan = Pengguna::where('role', 'pelanggan')->first();
        $produks = Produk::all();

        if (!$pelanggan || !$admin || $produks->count() < 4) {
            return;
        }

        $now = Carbon::now();

        // ----------------------------------------------------
        // 1. Pesanan Online: Selesai (15 hari lalu)
        // ----------------------------------------------------
        $tgl1 = $now->copy()->subDays(15);
        $pesanan1 = Pesanan::create([
            'id_user' => $pelanggan->id,
            'status' => 'selesai',
            'total_harga' => ($produks[0]->harga * 3) + ($produks[1]->harga * 2), // Benih Cabai + Tomat
            'alamat_pengiriman' => 'Jl. Merdeka No. 10, Jakarta Pusat',
            'tanggal_pesanan' => $tgl1,
            'created_at' => $tgl1,
            'updated_at' => $tgl1,
        ]);

        ItemPesanan::create([
            'id_pesanan' => $pesanan1->id,
            'id_produk' => $produks[0]->id,
            'jumlah' => 3,
            'harga_produk' => $produks[0]->harga,
            'subtotal' => $produks[0]->harga * 3,
        ]);

        ItemPesanan::create([
            'id_pesanan' => $pesanan1->id,
            'id_produk' => $produks[1]->id,
            'jumlah' => 2,
            'harga_produk' => $produks[1]->harga,
            'subtotal' => $produks[1]->harga * 2,
        ]);

        // Catat ke Laporan Keuangan
        LaporanKeuangan::create([
            'jenis_laporan' => 'pemasukan',
            'harga' => $pesanan1->total_harga,
            'deskripsi' => 'Penjualan Online - Pesanan #BNR-' . str_pad($pesanan1->id, 6, '0', STR_PAD_LEFT),
            'tanggal' => $tgl1->toDateString(),
            'id_pesanan' => $pesanan1->id,
            'created_at' => $tgl1,
            'updated_at' => $tgl1,
        ]);


        // ----------------------------------------------------
        // 2. Pesanan Online: Dikirim (10 hari lalu)
        // ----------------------------------------------------
        $tgl2 = $now->copy()->subDays(10);
        $pesanan2 = Pesanan::create([
            'id_user' => $pelanggan->id,
            'status' => 'dikirim',
            'total_harga' => ($produks[2]->harga * 5), // Benih Kangkung
            'alamat_pengiriman' => 'Jl. Sudirman No. 45, Jakarta Selatan',
            'tanggal_pesanan' => $tgl2,
            'created_at' => $tgl2,
            'updated_at' => $tgl2,
        ]);

        ItemPesanan::create([
            'id_pesanan' => $pesanan2->id,
            'id_produk' => $produks[2]->id,
            'jumlah' => 5,
            'harga_produk' => $produks[2]->harga,
            'subtotal' => $produks[2]->harga * 5,
        ]);


        // ----------------------------------------------------
        // 3. Pesanan Online: Diproses (5 hari lalu)
        // ----------------------------------------------------
        $tgl3 = $now->copy()->subDays(5);
        $pesanan3 = Pesanan::create([
            'id_user' => $pelanggan->id,
            'status' => 'diproses',
            'total_harga' => ($produks[3]->harga * 2) + ($produks[4]->harga * 1), // Benih Bayam + Jagung
            'alamat_pengiriman' => 'Jl. Gatot Subroto No. 12, Jakarta Barat',
            'tanggal_pesanan' => $tgl3,
            'created_at' => $tgl3,
            'updated_at' => $tgl3,
        ]);

        ItemPesanan::create([
            'id_pesanan' => $pesanan3->id,
            'id_produk' => $produks[3]->id,
            'jumlah' => 2,
            'harga_produk' => $produks[3]->harga,
            'subtotal' => $produks[3]->harga * 2,
        ]);

        ItemPesanan::create([
            'id_pesanan' => $pesanan3->id,
            'id_produk' => $produks[4]->id,
            'jumlah' => 1,
            'harga_produk' => $produks[4]->harga,
            'subtotal' => $produks[4]->harga * 1,
        ]);


        // ----------------------------------------------------
        // 4. Pesanan Online: Dibatalkan (2 hari lalu)
        // ----------------------------------------------------
        $tgl4 = $now->copy()->subDays(2);
        $pesanan4 = Pesanan::create([
            'id_user' => $pelanggan->id,
            'status' => 'dibatalkan',
            'total_harga' => ($produks[1]->harga * 10), // Benih Tomat
            'alamat_pengiriman' => 'Jl. Diponegoro No. 8, Jakarta Pusat',
            'tanggal_pesanan' => $tgl4,
            'created_at' => $tgl4,
            'updated_at' => $tgl4,
        ]);

        ItemPesanan::create([
            'id_pesanan' => $pesanan4->id,
            'id_produk' => $produks[1]->id,
            'jumlah' => 10,
            'harga_produk' => $produks[1]->harga,
            'subtotal' => $produks[1]->harga * 10,
        ]);


        // ----------------------------------------------------
        // 5. Pesanan Offline (Kasir): Selesai (12 hari lalu)
        // ----------------------------------------------------
        $tgl5 = $now->copy()->subDays(12);
        $pesanan5 = Pesanan::create([
            'id_user' => $admin->id,
            'status' => 'selesai',
            'total_harga' => ($produks[0]->harga * 10), // Benih Cabai
            'alamat_pengiriman' => 'Pembelian Offline (Kasir)',
            'tanggal_pesanan' => $tgl5,
            'created_at' => $tgl5,
            'updated_at' => $tgl5,
        ]);

        ItemPesanan::create([
            'id_pesanan' => $pesanan5->id,
            'id_produk' => $produks[0]->id,
            'jumlah' => 10,
            'harga_produk' => $produks[0]->harga,
            'subtotal' => $produks[0]->harga * 10,
        ]);

        // Catat ke Laporan Keuangan
        LaporanKeuangan::create([
            'jenis_laporan' => 'pemasukan',
            'harga' => $pesanan5->total_harga,
            'deskripsi' => 'Penjualan Offline (Kasir) - Pesanan #BNR-' . str_pad($pesanan5->id, 6, '0', STR_PAD_LEFT),
            'tanggal' => $tgl5->toDateString(),
            'id_pesanan' => $pesanan5->id,
            'created_at' => $tgl5,
            'updated_at' => $tgl5,
        ]);


        // ----------------------------------------------------
        // 6. Pesanan Offline (Kasir): Selesai (8 hari lalu)
        // ----------------------------------------------------
        $tgl6 = $now->copy()->subDays(8);
        $pesanan6 = Pesanan::create([
            'id_user' => $admin->id,
            'status' => 'selesai',
            'total_harga' => ($produks[4]->harga * 4) + ($produks[5]->harga * 5), // Benih Jagung + Terong
            'alamat_pengiriman' => 'Pembelian Offline (Kasir)',
            'tanggal_pesanan' => $tgl6,
            'created_at' => $tgl6,
            'updated_at' => $tgl6,
        ]);

        ItemPesanan::create([
            'id_pesanan' => $pesanan6->id,
            'id_produk' => $produks[4]->id,
            'jumlah' => 4,
            'harga_produk' => $produks[4]->harga,
            'subtotal' => $produks[4]->harga * 4,
        ]);

        ItemPesanan::create([
            'id_pesanan' => $pesanan6->id,
            'id_produk' => $produks[5]->id,
            'jumlah' => 5,
            'harga_produk' => $produks[5]->harga,
            'subtotal' => $produks[5]->harga * 5,
        ]);

        // Catat ke Laporan Keuangan
        LaporanKeuangan::create([
            'jenis_laporan' => 'pemasukan',
            'harga' => $pesanan6->total_harga,
            'deskripsi' => 'Penjualan Offline (Kasir) - Pesanan #BNR-' . str_pad($pesanan6->id, 6, '0', STR_PAD_LEFT),
            'tanggal' => $tgl6->toDateString(),
            'id_pesanan' => $pesanan6->id,
            'created_at' => $tgl6,
            'updated_at' => $tgl6,
        ]);


        // ----------------------------------------------------
        // 7. Pesanan Offline (Kasir): Selesai (1 hari lalu)
        // ----------------------------------------------------
        $tgl7 = $now->copy()->subDays(1);
        $pesanan7 = Pesanan::create([
            'id_user' => $admin->id,
            'status' => 'selesai',
            'total_harga' => ($produks[3]->harga * 15), // Benih Bayam
            'alamat_pengiriman' => 'Pembelian Offline (Kasir)',
            'tanggal_pesanan' => $tgl7,
            'created_at' => $tgl7,
            'updated_at' => $tgl7,
        ]);

        ItemPesanan::create([
            'id_pesanan' => $pesanan7->id,
            'id_produk' => $produks[3]->id,
            'jumlah' => 15,
            'harga_produk' => $produks[3]->harga,
            'subtotal' => $produks[3]->harga * 15,
        ]);

        // Catat ke Laporan Keuangan
        LaporanKeuangan::create([
            'jenis_laporan' => 'pemasukan',
            'harga' => $pesanan7->total_harga,
            'deskripsi' => 'Penjualan Offline (Kasir) - Pesanan #BNR-' . str_pad($pesanan7->id, 6, '0', STR_PAD_LEFT),
            'tanggal' => $tgl7->toDateString(),
            'id_pesanan' => $pesanan7->id,
            'created_at' => $tgl7,
            'updated_at' => $tgl7,
        ]);
    }
}
