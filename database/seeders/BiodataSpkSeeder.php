<?php

namespace Database\Seeders;

use App\Models\BiodataSpk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiodataSpkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        $user_ids = [
            3,
            4,
            5,
            6,
            7,
            8,
        ];

        $pekerjaan_ortus = [
            1,
            5,
            3,
            2,
            2,
            3,
        ];

        $gaji_ortus = [
            3,
            4,
            1,
            2,
            2,
            1,
        ];

        $luas_tanahs = [
            50,
            72,
            55,
            50,
            83,
            52,
        ];

        $kamars = [
            1,
            2,
            2,
            2,
            1,
            3,
        ];

        $kamar_mandis = [
            2,
            1,
            1,
            1,
            1,
            1,
        ];

        $tagihan_listriks = [
            1,
            4,
            2,
            2,
            3,
            3,
        ];

        $pajaks = [
            450000,
            750000,
            320000,
            400000,
            420000,
            500000,
        ];

        $hutangs = [
            2,
            1,
            2,
            2,
            3,
            2,
        ];

        $saudaras = [
            2,
            2,
            3,
            2,
            1,
            2,
        ];

        $status_ortus = [
            4,
            3,
            3,
            1,
            3,
            1,
        ];

        foreach ($user_ids as $index => $user_id) {
            $records[] = [
                'user_id' => $user_id,
                'pekerjaan_ortu_id' => $pekerjaan_ortus[$index],
                'gaji_ortu_id' => $gaji_ortus[$index],
                'luas_tanah' => $luas_tanahs[$index],
                'kamar' => $kamars[$index],
                'kamar_mandi_id' => $kamar_mandis[$index],
                'tagihan_listrik_id' => $tagihan_listriks[$index],
                'pajak' => $pajaks[$index],
                'hutang_id' => $hutangs[$index],
                'saudara_id' => $saudaras[$index],
                'status_ortu_id' => $status_ortus[$index],
            ];
        }

        BiodataSpk::insert($records);
    }
}
