<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['jurusan' => 'Teknik Elektro'],
            ['jurusan' => 'Teknik Kimia'],
            ['jurusan' => 'Teknik Mesin'],
            ['jurusan' => 'Teknik Sipil'],
            ['jurusan' => 'Akuntansi'],
            ['jurusan' => 'Administrasi Niaga'],
            ['jurusan' => 'Teknologi Informasi'],
            ['jurusan' => 'Bahasa'],
        ];

        Jurusan::insert($data);
    }
}
