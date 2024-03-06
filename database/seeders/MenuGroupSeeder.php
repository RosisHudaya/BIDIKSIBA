<?php

namespace Database\Seeders;

use App\Models\MenuGroup;
use Illuminate\Database\Seeder;

class MenuGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // MenuGroup::factory()->count(5)->create();
        MenuGroup::insert(
            [
                [
                    'name' => 'Dashboard',
                    'icon' => 'fas fa-tachometer-alt',
                    'permission_name' => 'dashboard',
                ],
                [
                    'name' => 'Users Management',
                    'icon' => 'fas fa-user',
                    'permission_name' => 'user.management',
                ],
                [
                    'name' => 'Kriteria Pendaftar',
                    'icon' => 'fas fa-user-tie',
                    'permisison_name' => 'menu.kriteria.pendaftar',
                ],
                [
                    'name' => 'Kriteria Ekonomi',
                    'icon' => 'fas fa-home',
                    'permisison_name' => 'menu.kriteria.ekonomi',
                ],
                [
                    'name' => 'Role Management',
                    'icon' => 'fas fa-user-tag',
                    'permisison_name' => 'role.permission.management',
                ],
                [
                    'name' => 'Pendidikan',
                    'icon' => 'fas fa-graduation-cap',
                    'permisison_name' => 'menu.pendidikan',
                ],
                [
                    'name' => 'Ujian',
                    'icon' => 'fas fa-file-contract',
                    'permisison_name' => 'menu.ujian',
                ],
                [
                    'name' => 'Menu Management',
                    'icon' => 'fas fa-bars',
                    'permisison_name' => 'menu.management',
                ]
            ]
        );
    }
}
