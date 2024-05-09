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
            ['id_asal_jurusan' => '1', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '1', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '2', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '2', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '3', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '3', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '4', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '4', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '5', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '5', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '6', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '6', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '7', 'id_jurusan' => '2'],
            ['id_asal_jurusan' => '7', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '7', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '8', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '8', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '9', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '9', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '10', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '10', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '11', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '11', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '12', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '12', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '13', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '13', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '14', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '14', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '15', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '15', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '16', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '16', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '17', 'id_jurusan' => '1'],
            ['id_asal_jurusan' => '17', 'id_jurusan' => '2'],
            ['id_asal_jurusan' => '17', 'id_jurusan' => '3'],
            ['id_asal_jurusan' => '17', 'id_jurusan' => '4'],
            ['id_asal_jurusan' => '17', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '17', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '18', 'id_jurusan' => '1'],
            ['id_asal_jurusan' => '18', 'id_jurusan' => '2'],
            ['id_asal_jurusan' => '18', 'id_jurusan' => '3'],
            ['id_asal_jurusan' => '18', 'id_jurusan' => '4'],
            ['id_asal_jurusan' => '18', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '18', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '19', 'id_jurusan' => '1'],
            ['id_asal_jurusan' => '19', 'id_jurusan' => '2'],
            ['id_asal_jurusan' => '19', 'id_jurusan' => '3'],
            ['id_asal_jurusan' => '19', 'id_jurusan' => '4'],
            ['id_asal_jurusan' => '19', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '19', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '20', 'id_jurusan' => '1'],
            ['id_asal_jurusan' => '20', 'id_jurusan' => '2'],
            ['id_asal_jurusan' => '20', 'id_jurusan' => '3'],
            ['id_asal_jurusan' => '20', 'id_jurusan' => '4'],
            ['id_asal_jurusan' => '20', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '20', 'id_jurusan' => '6'],
            ['id_asal_jurusan' => '21', 'id_jurusan' => '1'],
            ['id_asal_jurusan' => '21', 'id_jurusan' => '2'],
            ['id_asal_jurusan' => '21', 'id_jurusan' => '3'],
            ['id_asal_jurusan' => '21', 'id_jurusan' => '4'],
            ['id_asal_jurusan' => '21', 'id_jurusan' => '5'],
            ['id_asal_jurusan' => '21', 'id_jurusan' => '6'],
        ];

        AsalJurusanPivot::insert($data);
    }
}
