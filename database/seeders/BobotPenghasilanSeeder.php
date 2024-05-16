<?php

namespace Database\Seeders;

use App\Models\BobotPenghasilan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotPenghasilanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BobotPenghasilan::create([
            'fk' => 1,
            'penghasilan_ortu' => 1,
            'to_c1' => 3.03,
            'to_c5' => 5,
            'to_c6' => 5,
            'to_c8' => 3.03,
            'to_c9' => 1,
            'to_c10' => 0.33,
        ]);
    }
}
