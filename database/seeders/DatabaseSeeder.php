<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RoleAndPermissionSeeder::class,
            MenuGroupSeeder::class,
            MenuItemSeeder::class,
            CategorySeeder::class,
            AsalJurusanSeeder::class,
            JurusanSeeder::class,
            AsalJurusanPivotSeeder::class,
            ProdiSeeder::class,
            PekerjaanOrtuSeeder::class,
            GajiOrtuSeeder::class,
            KamarMandiSeeder::class,
            TagihanListrikSeeder::class,
            HutangSeeder::class,
            SaudaraSeeder::class,
            StatusOrtuSeeder::class,
            BobotSeeder::class,
                // BiodataSeeder::class,
                // BiodataSpkSeeder::class,
            BobotPekerjaanSeeder::class,
            BobotPenghasilanSeeder::class,
            BobotTanahSeeder::class,
            BobotKamarSeeder::class,
            BobotKamarMandiSeeder::class,
            BobotListrikSeeder::class,
            BobotPajakSeeder::class,
            BobotHutangSeeder::class,
            BobotSaudaraSeeder::class,
            BobotStatusOrtusSeeder::class,
        ]);
    }
}
