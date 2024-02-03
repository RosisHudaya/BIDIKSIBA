<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id_jurusan' => '1', 'prodi' => 'D3 Teknik Elektro'],
            ['id_jurusan' => '1', 'prodi' => 'D3 Teknik Telekomunikasi'],
            ['id_jurusan' => '1', 'prodi' => 'D3 Teknik Listrik'],
            ['id_jurusan' => '2', 'prodi' => 'D3 Teknik Kimia'],
            ['id_jurusan' => '3', 'prodi' => 'D3 Teknik Mesin'],
            ['id_jurusan' => '3', 'prodi' => 'D3 Teknik Pemeliharaan Pesawat Terbang'],
            ['id_jurusan' => '4', 'prodi' => 'D3 Teknik Sipil'],
            ['id_jurusan' => '4', 'prodi' => 'D3 Teknik Pertambangan'],
            ['id_jurusan' => '4', 'prodi' => 'D3 Teknik Konstruksi Jalan, Jembatan, Dan Bangunan Air'],
            ['id_jurusan' => '5', 'prodi' => 'D3 Akuntansi'],
            ['id_jurusan' => '6', 'prodi' => 'D3 Administrasi Niaga'],
            ['id_jurusan' => '7', 'prodi' => 'D4 Teknik Informatika'],
            ['id_jurusan' => '7', 'prodi' => 'D4 Teknik Informatika (double Degree Sau China)'],
            ['id_jurusan' => '7', 'prodi' => 'D4 Sistem Informasi Bisnis'],
        ];

        Prodi::insert($data);
    }
}
