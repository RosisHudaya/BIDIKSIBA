<?php

namespace Database\Seeders;

use App\Models\AsalJurusanPivot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsalJurusanPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id_asal_jurusan' => '1', 'id_jurusan' => '1'],
            ['id_asal_jurusan' => '1', 'id_jurusan' => '2'],
            ['id_asal_jurusan' => '1', 'id_jurusan' => '3'],
            ['id_asal_jurusan' => '1', 'id_jurusan' => '4'],
            ['id_asal_jurusan' => '2', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '2', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '1', 'id_jurusan' => '7'],
            ['id_asal_jurusan' => '1', 'id_jurusan' => '8'],
            ['id_asal_jurusan' => '2', 'id_jurusan' => '8'],
        ];

        AsalJurusanPivot::insert($data);
    }
}
