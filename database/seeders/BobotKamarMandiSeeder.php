<?php

namespace Database\Seeders;

use App\Models\BobotKamarMandi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotKamarMandiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BobotKamarMandi::create([
            'fk' => 1,
            'kamar_mandi' => 1,
            'to_c1' => 0.33,
            'to_c2' => 0.2,
            'to_c6' => 1,
            'to_c8' => 0.33,
            'to_c9' => 0.2,
            'to_c10' => 0.14,
        ]);
    }
}
