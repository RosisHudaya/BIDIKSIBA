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
            "Tidak Memilki",
            "1 - 3 saudara",
            "Lebih dari 3 saudara",
        ];

        $nilais = [
            1,
            3,
            5,
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
