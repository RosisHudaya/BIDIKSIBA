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
            0.071,
            0.162,
            0.071,
            0.017,
            0.032,
            0.032,
            0.071,
            0.071,
            0.162,
            0.311,
        ];

        foreach ($kriterias as $index => $kriteria) {
            $records[] = [
                'kriteria' => $kriteria,
                'bobot' => $bobots[$index],
            ];
        }

        Bobot::insert($records);
    }
}
