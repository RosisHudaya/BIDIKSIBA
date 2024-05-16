<?php

namespace Database\Seeders;

use App\Models\BobotStatusOrtus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotStatusOrtusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BobotStatusOrtus::create([
            'fk' => 1,
            'status_ortu' => 1,
            'to_c1' => 5,
            'to_c2' => 3.03,
            'to_c5' => 7.14,
            'to_c6' => 7.14,
            'to_c8' => 5,
            'to_c9' => 3.03,
        ]);
    }
}
