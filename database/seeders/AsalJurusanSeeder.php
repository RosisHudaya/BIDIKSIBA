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
            ['asal_jurusan' => 'Teknik Listrik'],
            ['asal_jurusan' => 'Teknik Elektronika'],
            ['asal_jurusan' => 'Teknik Pembangkit Listrik'],
            ['asal_jurusan' => 'Teknik Otomasi Industri'],
            ['asal_jurusan' => 'Teknik Kontrol Otomasi'],
            ['asal_jurusan' => 'Teknik Mekatronika'],
            ['asal_jurusan' => 'Teknik Telekomunikasi'],
            ['asal_jurusan' => 'Teknik Instrumentai dan Kontrol'],
            ['asal_jurusan' => 'Teknik Komputer dan Jaringan'],
            ['asal_jurusan' => 'Teknik Kelistrikan'],
            ['asal_jurusan' => 'Teknik Kimia Industri'],
            ['asal_jurusan' => 'Teknik Kimia Analisis'],
            ['asal_jurusan' => 'Teknik Laboratorium Kimia'],
            ['asal_jurusan' => 'Teknik Proses Pengolahan Hasil Pertanian'],
            ['asal_jurusan' => 'Teknik Pembuatan Produk Kimia'],
            ['asal_jurusan' => 'Teknik Mesin'],
            ['asal_jurusan' => 'Teknik Otomotif'],
            ['asal_jurusan' => 'Teknik Mekanik Otomotif'],
            ['asal_jurusan' => 'Teknik Fabrikasi Logam'],
            ['asal_jurusan' => 'Teknik Permesinan'],
            ['asal_jurusan' => 'Teknik Pengelasan'],
        ];

        AsalJurusan::insert($data);
    }
}
