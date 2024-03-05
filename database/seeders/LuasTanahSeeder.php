<?php

namespace Database\Seeders;

use App\Models\LuasTanah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LuasTanahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        $luas_tanahs = [
            "50 meter",
            "50 - 100 meter",
            "100 - 150 meter",
            "150 - 200 meter",
            "Lebih dari 200 meter",
        ];

        $nilais = [
            5,
            4,
            3,
            2,
            1,
        ];

        foreach ($luas_tanahs as $index => $luas_tanah) {
            $records[] = [
                'luas_tanah' => $luas_tanah,
                'nilai' => $nilais[$index],
            ];
        }

        LuasTanah::insert($records);
    }
}
