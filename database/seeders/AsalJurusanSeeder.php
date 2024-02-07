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
            ['asal_jurusan' => 'TKJ (Teknik Komputer dan Jaringan)'],
            ['asal_jurusan' => 'RPL (Rekayasa Perangkat Lunak)'],
            ['asal_jurusan' => 'MULTIMEDIA'],
        ];

        AsalJurusan::insert($data);
    }
}
