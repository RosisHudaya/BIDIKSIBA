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

        $namas = [
            "Siswa A",
            "Siswa B",
            "Siswa C",
            "Siswa D",
            "Siswa E",
            "Siswa F",
            "Siswa G",
            "Siswa H",
            "Siswa I",
            "Siswa J",
            "Siswa K",
            "Siswa L",
            "Siswa M",
            "Siswa N",
            "Siswa O",
            "Siswa P",
            "Siswa Q",
            "Siswa R",
            "Siswa S",
            "Siswa T",
        ];

        $asal_sekolahs = [
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
            "SMKN 3 Boyolangu",
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
            'Perempuan',
            'Laki-laki',
            'Perempuan',
            'Perempuan',
            'Perempuan',
            'Perempuan',
            'Laki-laki',
            'Perempuan',
            'Perempuan',
            'Perempuan',
            'Perempuan',
            'Laki-laki',
            'Perempuan',
            'Perempuan',
        ];

        $statuses = [
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            // 'Pending',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
            'Diverifikasi',
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
