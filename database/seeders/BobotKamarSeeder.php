<?php

namespace Database\Seeders;

use App\Models\BobotKamar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BobotKamar::create([
            'fk' => 1,
            'jumlah_kamar' => 1,
            'to_c3' => 0.2,
            'to_c7' => 0.2,
        ]);
    }
}
