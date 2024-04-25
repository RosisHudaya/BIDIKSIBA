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
            BiodataSeeder::class,
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
            BiodataSpkSeeder::class,
        ]);
    }
}
