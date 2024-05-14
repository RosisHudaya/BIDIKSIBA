<?php

namespace Database\Seeders;

use App\Models\PekerjaanOrtu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PekerjaanOrtuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        $pekerjaan_ortus = [
            "Wiraswasta",
            "Outsourcing",
            "Serabutan",
            "Honorer",
            "Tidak Bekerja",
        ];

        $nilais = [
            1,
            2,
            3,
            4,
            5,
        ];

        foreach ($pekerjaan_ortus as $index => $pekerjaan_ortu) {
            $records[] = [
                'pekerjaan_ortu' => $pekerjaan_ortu,
                'nilai' => $nilais[$index],
            ];
        }

        PekerjaanOrtu::insert($records);
    }
}
