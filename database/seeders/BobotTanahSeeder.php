<?php

namespace Database\Seeders;

use App\Models\BobotTanah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotTanahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BobotTanah::create([
            'fk' => 1,
            'luas_tanah' => 1,
            'to_c4' => 5,
            'to_c7' => 1,
        ]);
    }
}
