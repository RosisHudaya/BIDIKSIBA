<?php

namespace Database\Seeders;

use App\Models\AsalJurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsalJurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['asal_jurusan' => 'IPA'],
            ['asal_jurusan' => 'IPS'],
            ['asal_jurusan' => 'Akuntansi'],
            ['asal_jurusan' => 'Administrasi Perkantoran'],
            ['asal_jurusan' => 'Farmasi'],
            ['asal_jurusan' => 'Keperawatan'],
            ['asal_jurusan' => 'Kimia Analisis'],
            ['asal_jurusan' => 'Manajemen Bisnis'],
            ['asal_jurusan' => 'Pelayaran'],
            ['asal_jurusan' => 'Perhotelan'],
            ['asal_jurusan' => 'Perbankan dan Keuangan Syariah'],
            ['asal_jurusan' => 'Tata Boga'],
            ['asal_jurusan' => 'Tata Busana'],
            ['asal_jurusan' => 'Tata Rias dan Kecantikan'],
            ['asal_jurusan' => 'Usaha Perjalanan Wisata'],
            ['asal_jurusan' => 'Multimedia'],
            ['asal_jurusan' => 'Rekayasa Perangkat Lunak'],
            ['asal_jurusan' => 'Teknik Komputer Jaringan'],
            ['asal_jurusan' => 'Teknik Kendaraan Ringan'],
            ['asal_jurusan' => 'Teknik Elektronika'],
            ['asal_jurusan' => 'Teknik Gambar Bangunan'],
        ];

        AsalJurusan::insert($data);
    }
}
