<?php

namespace Database\Seeders;

use App\Models\BobotListrik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotListrikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BobotListrik::create([
            'fk' => 1,
            'tagihan_listrik' => 1,
            'to_c1' => 0.33,
            'to_c2' => 0.2,
            'to_c5' => 1,
            'to_c8' => 0.33,
            'to_c9' => 0.2,
            'to_c10' => 0.14,
        ]);
    }
}
