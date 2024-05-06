<?php

namespace Database\Seeders;

use App\Models\Pajak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PajakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        $pajaks = [
            "Kurang dari 500 Ribu",
            "500 - 1 Juta",
            "Lebih dari 1 Juta",
        ];

        $nilais = [
            5,
            3,
            1,
        ];

        foreach ($pajaks as $index => $pajak) {
            $records[] = [
                'pajak' => $pajak,
                'nilai' => $nilais[$index],
            ];
        }

        Pajak::insert($records);
    }
}
