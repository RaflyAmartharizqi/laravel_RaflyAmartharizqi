<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pasien')->insert([
            ['nama_pasien' => 'Andi', 'alamat_pasien' => 'Jl. Merdeka No.1', 'no_telp' => '081234567890', 'id_rumah_sakit' => 1],
            ['nama_pasien' => 'Budi', 'alamat_pasien' => 'Jl. Sudirman No.2', 'no_telp' => '082345678901', 'id_rumah_sakit' => 2],
            ['nama_pasien' => 'Citra', 'alamat_pasien' => 'Jl. Thamrin No.3', 'no_telp' => '083456789012', 'id_rumah_sakit' => 2],
            ['nama_pasien' => 'Dewi', 'alamat_pasien' => 'Jl. Gajah Mada No.4', 'no_telp' => '084567890123', 'id_rumah_sakit' => 3],
            ['nama_pasien' => 'Eka', 'alamat_pasien' => 'Jl. Hayam Wuruk No.5', 'no_telp' => '085678901234', 'id_rumah_sakit' => 3],
            ['nama_pasien' => 'Fajar', 'alamat_pasien' => 'Jl. Pahlawan No.6', 'no_telp' => '086789012345', 'id_rumah_sakit' => 5],
            ['nama_pasien' => 'Gina', 'alamat_pasien' => 'Jl. Diponegoro No.7', 'no_telp' => '087890123456', 'id_rumah_sakit' => 4],
            ['nama_pasien' => 'Hadi', 'alamat_pasien' => 'Jl. Kartini No.8', 'no_telp' => '088901234567', 'id_rumah_sakit' => 6],
            ['nama_pasien' => 'Intan', 'alamat_pasien' => 'Jl. Sisingamangaraja No.9', 'no_telp' => '089012345678', 'id_rumah_sakit' => 3],
            ['nama_pasien' => 'Joko', 'alamat_pasien' => 'Jl. Ahmad Yani No.10', 'no_telp' => '081123456789', 'id_rumah_sakit' => 1],
        ]);
    }
}
