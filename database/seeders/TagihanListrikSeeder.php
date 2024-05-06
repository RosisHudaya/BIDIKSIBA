<?php

namespace Database\Seeders;

use App\Models\TagihanListrik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagihanListrikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        $tagihan_listriks = [
            "Tidak Memiliki",
            "450 Watt",
            "900 Watt",
            "1300 Watt",
        ];

        $nilais = [
            5,
            3,
            3,
            1,
        ];

        foreach ($tagihan_listriks as $index => $tagihan_listrik) {
            $records[] = [
                'tagihan_listrik' => $tagihan_listrik,
                'nilai' => $nilais[$index],
            ];
        }

        TagihanListrik::insert($records);
    }
}
