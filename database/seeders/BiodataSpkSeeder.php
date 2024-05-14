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
            9,
            10,
            11,
            12,
            13,
            14,
            15,
            16,
            17,
            18,
            19,
            20,
            21,
            22,
        ];

        $pekerjaan_ortus = [
            5,
            1,
            3,
            4,
            4,
            3,
            1,
            5,
            1,
            3,
            3,
            5,
            5,
            4,
            3,
            2,
            5,
            3,
            3,
            4,
        ];

        $gaji_ortus = [
            5,
            2,
            5,
            4,
            4,
            5,
            5,
            5,
            4,
            5,
            4,
            5,
            5,
            5,
            5,
            3,
            5,
            4,
            4,
            5,
        ];

        $luas_tanahs = [
            90,
            123,
            120,
            110,
            108,
            90,
            104,
            240,
            100,
            150,
            120,
            110,
            98,
            100,
            102,
            120,
            97,
            105,
            105,
            100,

        ];

        $kamars = [
            1,
            2,
            2,
            2,
            1,
            3,
            3,
            3,
            4,
            3,
            4,
            5,
            2,
            3,
            2,
            5,
            3,
            3,
            3,
            4,
        ];

        $kamar_mandis = [
            1,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            1,
            2,
            2,
            2,
            1,
            2,
            2,
            2,
        ];

        $tagihan_listriks = [
            1,
            4,
            3,
            3,
            3,
            3,
            3,
            1,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
        ];

        $pajaks = [
            172300,
            293400,
            278000,
            234500,
            221000,
            150350,
            182500,
            394000,
            200000,
            222000,
            221500,
            205500,
            189500,
            205000,
            210000,
            224000,
            195000,
            175000,
            224500,
            245000,
        ];

        $hutangs = [
            2,
            3,
            2,
            2,
            1,
            2,
            1,
            1,
            3,
            2,
            1,
            1,
            3,
            1,
            1,
            1,
            2,
            2,
            1,
            1,
        ];

        $saudaras = [
            2,
            2,
            1,
            2,
            3,
            2,
            3,
            2,
            2,
            2,
            2,
            3,
            3,
            2,
            2,
            2,
            2,
            2,
            3,
            2,
        ];

        $status_ortus = [
            4,
            3,
            3,
            1,
            3,
            1,
            4,
            2,
            3,
            4,
            4,
            1,
            4,
            2,
            2,
            3,
            3,
            3,
            4,
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
