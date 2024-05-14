<?php

namespace Database\Seeders;

use App\Models\Hutang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HutangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        $hutangs = [
            "Tidak Memiliki",
            "Kurang dari 1 Juta",
            "Lebih dari 1 Juta",
        ];

        $nilais = [
            1,
            3,
            5,
        ];

        foreach ($hutangs as $index => $hutang) {
            $records[] = [
                'hutang' => $hutang,
                'nilai' => $nilais[$index],
            ];
        }

        Hutang::insert($records);
    }
}
