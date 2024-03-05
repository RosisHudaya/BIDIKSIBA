<?php

namespace Database\Seeders;

use App\Models\KamarMandi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KamarMandiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        $kamar_mandis = [
            "Memiliki",
            "Tidak Memiliki",
        ];

        $nilais = [
            5,
            1,
        ];

        foreach ($kamar_mandis as $index => $kamar_mandi) {
            $records[] = [
                'kamar_mandi' => $kamar_mandi,
                'nilai' => $nilais[$index],
            ];
        }

        KamarMandi::insert($records);
    }
}
