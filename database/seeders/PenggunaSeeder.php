<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengguna::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'role' => 'admin',
            'no_telp' => '081234567890',
        ]);

        Pengguna::create([
            'nama' => 'Zaki',
            'email' => 'latifulzakimubarak@gmail.com',
            'password' => 'password',
            'role' => 'pelanggan',
            'no_telp' => '081234567891',
        ]);

        Pengguna::create([
            'nama' => 'Ryan',
            'email' => 'ryan@gmail.com',
            'password' => 'password',
            'role' => 'investor',
            'no_telp' => '081234567892',
        ]);
    }
}
