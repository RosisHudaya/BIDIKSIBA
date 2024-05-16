<?php

namespace Database\Seeders;

use App\Models\BobotPajak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotPajakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BobotPajak::create([
            'fk' => 1,
            'pajak' => 1,
            'to_c3' => 1,
            'to_c4' => 5,
        ]);
    }
}
