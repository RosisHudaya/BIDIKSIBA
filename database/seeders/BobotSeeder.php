<?php

namespace Database\Seeders;

use App\Models\Bobot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        $kriterias = [
            "Pekerjaan Orang Tua",
            "Penghasilan Orang Tua",
            "Luas Tanah",
            "Jumlah Kamar",
            "Kepemilikan Kamar Mandi",
            "Tagihan Listrik",
            "Pajak Bumi dan Bangunan",
            "Jumlah Hutang",
            "Jumlah Saudara",
            "Status Orang Tua",
        ];

        $bobots = [
            0.07103879,
            0.162271817,
            0.07103879,
            0.017205067,
            0.031592428,
            0.031592428,
            0.07103879,
            0.07103879,
            0.162271817,
            0.310911284,
        ];

        $jenises = [
            "BENEFIT",
            "BENEFIT",
            "COST",
            "COST",
            "BENEFIT",
            "BENEFIT",
            "COST",
            "BENEFIT",
            "BENEFIT",
            "BENEFIT",
        ];

        foreach ($kriterias as $index => $kriteria) {
            $records[] = [
                'kriteria' => $kriteria,
                'jenis' => $jenises[$index],
                'bobot' => $bobots[$index],
            ];
        }

        Bobot::insert($records);
    }
}
