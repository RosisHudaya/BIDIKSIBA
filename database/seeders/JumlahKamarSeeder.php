<?php

namespace Database\Seeders;

use App\Models\JumlahKamar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JumlahKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        $jumlah_kamars = [
            "1 Kamar",
            "2 Kamar",
            "3 Kamar",
            "4 Kamar",
            "Lebih dari 4 Kamar",
        ];

        $nilais = [
            5,
            4,
            3,
            2,
            1,
        ];

        foreach ($jumlah_kamars as $index => $jumlah_kamar) {
            $records[] = [
                'jumlah_kamar' => $jumlah_kamar,
                'nilai' => $nilais[$index],
            ];
        }

        JumlahKamar::insert($records);
    }
}
