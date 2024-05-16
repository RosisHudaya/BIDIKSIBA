<?php

namespace Database\Seeders;

use App\Models\BobotSaudara;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotSaudaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BobotSaudara::create([
            'fk' => 1,
            'saudara' => 1,
            'to_c1' => 3.03,
            'to_c2' => 1,
            'to_c5' => 5,
            'to_c6' => 5,
            'to_c8' => 3.03,
            'to_c10' => 0.33,
        ]);
    }
}
