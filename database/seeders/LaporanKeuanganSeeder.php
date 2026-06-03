<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LaporanKeuangan;
use Carbon\Carbon;

class LaporanKeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Seeder ini khusus menyuplai data Pengeluaran yang tidak terikat dengan pesanan (id_pesanan = null)
        $data = [
            [
                'jenis_laporan' => 'pengeluaran',
                'harga' => 150000.00,
                'deskripsi' => 'Pembelian plastik kemasan produk benih',
                'tanggal' => $now->copy()->subDays(2)->toDateString(),
                'id_pesanan' => null,
            ],
            [
                'jenis_laporan' => 'pengeluaran',
                'harga' => 500000.00,
                'deskripsi' => 'Biaya perawatan mesin penggilingan dan pembersihan benih',
                'tanggal' => $now->copy()->subDays(5)->toDateString(),
                'id_pesanan' => null,
            ],
            [
                'jenis_laporan' => 'pengeluaran',
                'harga' => 200000.00,
                'deskripsi' => 'Biaya transportasi/bensin pengiriman benih ke pelanggan',
                'tanggal' => $now->copy()->subDays(10)->toDateString(),
                'id_pesanan' => null,
            ],
            [
                'jenis_laporan' => 'pengeluaran',
                'harga' => 1000000.00,
                'deskripsi' => 'Pembelian bahan baku benih padi mentah untuk diproses',
                'tanggal' => $now->copy()->subDays(15)->toDateString(),
                'id_pesanan' => null,
            ],
            [
                'jenis_laporan' => 'pengeluaran',
                'harga' => 80000.00,
                'deskripsi' => 'Pembelian alat kebersihan gudang benih',
                'tanggal' => $now->copy()->subDays(20)->toDateString(),
                'id_pesanan' => null,
            ],
            [
                'jenis_laporan' => 'pengeluaran',
                'harga' => 300000.00,
                'deskripsi' => 'Pembayaran tagihan listrik dan air gudang/toko',
                'tanggal' => $now->copy()->subDays(25)->toDateString(),
                'id_pesanan' => null,
            ],
        ];

        foreach ($data as $row) {
            LaporanKeuangan::create($row);
        }
    }
}
