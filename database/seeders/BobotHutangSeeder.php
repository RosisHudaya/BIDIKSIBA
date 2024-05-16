<?php

namespace Database\Seeders;

use App\Models\BobotHutang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotHutangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BobotHutang::create([
            'fk' => 1,
            'hutang' => 1,
            'to_c1' => 1,
            'to_c2' => 0.33,
            'to_c5' => 3.03,
            'to_c6' => 3.03,
            'to_c9' => 0.33,
            'to_c10' => 0.2,
        ]);
    }
}
