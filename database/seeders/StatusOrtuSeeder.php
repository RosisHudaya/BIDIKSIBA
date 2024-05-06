<?php

namespace Database\Seeders;

use App\Models\StatusOrtu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusOrtuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        $status_ortus = [
            "Yatim Piatu",
            "Yatim",
            "Piatu",
            "Tidak Semuanya",
        ];

        $nilais = [
            5,
            4,
            3,
            1,
        ];

        foreach ($status_ortus as $index => $status_ortu) {
            $records[] = [
                'status_ortu' => $status_ortu,
                'nilai' => $nilais[$index],
            ];
        }

        StatusOrtu::insert($records);
    }
}
