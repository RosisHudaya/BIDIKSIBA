<?php

namespace Database\Seeders;

use App\Models\GajiOrtu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GajiOrtuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        $gaji_ortus = [
            "0 - 1 Juta",
            "1 - 2 Juta",
            "2 - 3 Juta",
            "3 - 4 Juta",
            "Lebih dari 4 Juta",
        ];

        $nilais = [
            5,
            4,
            3,
            2,
            1,
        ];

        foreach ($gaji_ortus as $index => $gaji_ortu) {
            $records[] = [
                'gaji_ortu' => $gaji_ortu,
                'nilai' => $nilais[$index],
            ];
        }

        GajiOrtu::insert($records);
    }
}
