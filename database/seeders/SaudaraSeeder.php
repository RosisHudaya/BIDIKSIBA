<?php

namespace Database\Seeders;

use App\Models\Saudara;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaudaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        $saudaras = [
            "Lebih dari 4 saudara",
            "2 - 3 saudara",
            "Tidak Memilki",
        ];

        $nilais = [
            5,
            3,
            1,
        ];

        foreach ($saudaras as $index => $saudara) {
            $records[] = [
                'saudara' => $saudara,
                'nilai' => $nilais[$index],
            ];
        }

        Saudara::insert($records);
    }
}
