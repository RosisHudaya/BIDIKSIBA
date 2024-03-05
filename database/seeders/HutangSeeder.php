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
            "Lebih dari 1 Juta",
            "Kurang dari 1 Juta",
            "Tidak Memiliki",
        ];

        $nilais = [
            5,
            3,
            1,
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
