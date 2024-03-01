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
            ['id_jurusan' => '1', 'prodi' => 'D3 Teknik Elektronika'],
            ['id_jurusan' => '1', 'prodi' => 'D3 Teknik Listrik'],
            ['id_jurusan' => '1', 'prodi' => 'D3 Teknik Telekomunikasi'],
            ['id_jurusan' => '2', 'prodi' => 'D3 Teknik Kimia'],
            ['id_jurusan' => '3', 'prodi' => 'D3 Teknik Mesin'],
            ['id_jurusan' => '3', 'prodi' => 'D3 Teknologi Pemeliharaan Pesawat Udara'],
            ['id_jurusan' => '4', 'prodi' => 'D3 Teknik Sipil'],
            ['id_jurusan' => '4', 'prodi' => 'D3 Teknologi Konstruksi Jalan,Jembatan, dan Banguan Air'],
            ['id_jurusan' => '4', 'prodi' => 'D3 Teknologi Pertambangan'],
            ['id_jurusan' => '5', 'prodi' => 'D3 Akuntasi'],
            ['id_jurusan' => '6', 'prodi' => 'D3 Administrasi Bisnis'],
        ];

        Prodi::insert($data);
    }
}
