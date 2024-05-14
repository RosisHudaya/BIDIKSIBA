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
            "Lebih dari 4 Juta",
            "Lebih dari 3 - 4 Juta",
            "Lebih dari 2 - 3 Juta",
            "Lebih dari 1 - 2 Juta",
            "0 - 1 Juta",
        ];

        $nilais = [
            1,
            2,
            3,
            4,
            5,
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
