<?php

namespace Database\Seeders;

use App\Models\Biodata;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiodataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        $id_users = [
            3,
            4,
            5,
            6,
            7,
            8,
        ];

        $namas = [
            "Cantika Putri",
            "Angelia Doll",
            "Wawan Inazuma",
            "Nadya Aulia",
            "Naila Erliyan",
            "Latifatul Qolbiyah",
        ];

        $asal_sekolahs = [
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
        ];

        $genders = [
            'Perempuan',
            'Perempuan',
            'Laki-laki',
            'Perempuan',
            'Perempuan',
            'Perempuan',
        ];

        $statuses = [
            'Pending',
            'Pending',
            'Pending',
            'Pending',
            'Pending',
            'Pending',
        ];

        foreach ($id_users as $index => $id_user) {
            $records[] = [
                'id_user' => $id_user,
                'nama' => $namas[$index],
                'asal_sekolah' => $asal_sekolahs[$index],
                'gender' => $genders[$index],
                'status' => $statuses[$index],
            ];
        }

        Biodata::insert($records);
    }
}
