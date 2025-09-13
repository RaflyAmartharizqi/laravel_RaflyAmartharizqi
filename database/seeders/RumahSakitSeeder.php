<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rumah_sakit')->insert([
            ['nama_rumah_sakit' => 'RS Umum Jakarta', 'alamat_rumah_sakit' => 'Jl. Sudirman No.1', 'no_telp' => '021111'],
            ['nama_rumah_sakit' => 'RS Sehat Bandung', 'alamat_rumah_sakit' => 'Jl. Asia Afrika No.2', 'no_telp' => '022222'],
            ['nama_rumah_sakit' => 'RS Medika Surabaya', 'alamat_rumah_sakit' => 'Jl. Pemuda No.3', 'no_telp' => '031333'],
            ['nama_rumah_sakit' => 'RS Harapan Medan', 'alamat_rumah_sakit' => 'Jl. Gatot Subroto No.4', 'no_telp' => '061444'],
            ['nama_rumah_sakit' => 'RS Bahagia Bali', 'alamat_rumah_sakit' => 'Jl. Kuta No.5', 'no_telp' => '036555'],
            ['nama_rumah_sakit' => 'RS Sentosa Yogyakarta', 'alamat_rumah_sakit' => 'Jl. Malioboro No.6', 'no_telp' => '027666'],
            ['nama_rumah_sakit' => 'RS Pelita Semarang', 'alamat_rumah_sakit' => 'Jl. Pandanaran No.7', 'no_telp' => '024777'],
            ['nama_rumah_sakit' => 'RS Mitra Palembang', 'alamat_rumah_sakit' => 'Jl. Jendral Sudirman No.8', 'no_telp' => '071888'],
            ['nama_rumah_sakit' => 'RS Bunda Makassar', 'alamat_rumah_sakit' => 'Jl. Sultan Hasanuddin No.9', 'no_telp' => '041999'],
            ['nama_rumah_sakit' => 'RS Keluarga Aceh', 'alamat_rumah_sakit' => 'Jl. Teuku Umar No.10', 'no_telp' => '065000'],
        ]);
    }
}
