<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // MenuItem::factory()->count(10)->create();
        MenuItem::insert(
            [
                [
                    'name' => 'Dashboard',
                    'route' => 'dashboard',
                    'permission_name' => 'dashboard',
                    'menu_group_id' => 1,
                ],
                [
                    'name' => 'List User',
                    'route' => 'user-management/user',
                    'permission_name' => 'user.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => 'Verifikasi Pendaftar',
                    'route' => 'user-management/verifikasi-pendaftar',
                    'permission_name' => 'verif-admin.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => 'Akun Ujian',
                    'route' => 'user-management/akun-ujian',
                    'permission_name' => 'akun-ujian.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => 'Pekerjaan Orang Tua',
                    'route' => 'menu-kriteria-pendaftar/pekerjaan-ortu',
                    'permission_name' => 'pekerjaan-ortu.index',
                    'menu_group_id' => 3,
                ],
                [
                    'name' => 'Penghasilan Orang Tua',
                    'route' => 'menu-kriteria-pendaftar/penghasilan-ortu',
                    'permission_name' => 'penghasilan-ortu.index',
                    'menu_group_id' => 3,
                ],
                [
                    'name' => 'Saudara',
                    'route' => 'menu-kriteria-pendaftar/saudara',
                    'permission_name' => 'saudara.index',
                    'menu_group_id' => 3,
                ],
                [
                    'name' => 'Status Orang Tua',
                    'route' => 'menu-kriteria-pendaftar/status-ortu',
                    'permission_name' => 'status-ortu.index',
                    'menu_group_id' => 3,
                ],
                [
                    'name' => 'Kamar Mandi',
                    'route' => 'menu-kriteria-ekonomi/kamar-mandi',
                    'permission_name' => 'kamar-mandi.index',
                    'menu_group_id' => 4,
                ],
                [
                    'name' => 'Tagihan Listrik',
                    'route' => 'menu-kriteria-ekonomi/tagihan-listrik',
                    'permission_name' => 'tagihan-listrik.index',
                    'menu_group_id' => 4,
                ],
                [
                    'name' => 'Hutang',
                    'route' => 'menu-kriteria-ekonomi/hutang',
                    'permission_name' => 'hutang.index',
                    'menu_group_id' => 4,
                ],
                [
                    'name' => 'Role List',
                    'route' => 'role-and-permission/role',
                    'permission_name' => 'role.index',
                    'menu_group_id' => 5,
                ],
                // [
                //     'name' => 'Permission List',
                //     'route' => 'role-and-permission/permission',
                //     'permission_name' => 'permission.index',
                //     'menu_group_id' => 5,
                // ],
                // [
                //     'name' => 'Permission To Role',
                //     'route' => 'role-and-permission/assign',
                //     'permission_name' => 'assign.index',
                //     'menu_group_id' => 5,
                // ],
                [
                    'name' => 'User To Role',
                    'route' => 'role-and-permission/assign-user',
                    'permission_name' => 'assign.user.index',
                    'menu_group_id' => 5,
                ],
                [
                    'name' => 'Bobot Kriteria',
                    'route' => 'menu-ranking/bobot-kriteria',
                    'permission_name' => 'bobot-kriteria.index',
                    'menu_group_id' => 6,
                ],
                [
                    'name' => 'Ranking Ekonomi',
                    'route' => 'menu-ranking/data-ekonomi',
                    'permission_name' => 'data-ekonomi.index',
                    'menu_group_id' => 6,
                ],
                [
                    'name' => 'Ranking BIDIKSIBA',
                    'route' => 'menu-ranking/data-spk',
                    'permission_name' => 'data-spk.index',
                    'menu_group_id' => 6,
                ],
                [
                    'name' => 'Asal Jurusan SMA/SMK',
                    'route' => 'menu-pendidikan/asal-jurusan',
                    'permission_name' => 'asal-jurusan.index',
                    'menu_group_id' => 7,
                ],
                [
                    'name' => 'Jurusan',
                    'route' => 'menu-pendidikan/jurusan',
                    'permission_name' => 'jurusan.index',
                    'menu_group_id' => 7,
                ],
                [
                    'name' => 'Program Studi',
                    'route' => 'menu-pendidikan/program-studi',
                    'permission_name' => 'prodi.index',
                    'menu_group_id' => 7,
                ],
                [
                    'name' => 'Soal Ujian',
                    'route' => 'menu-ujian/ujian',
                    'permission_name' => 'ujian.index',
                    'menu_group_id' => 8,
                ],
                [
                    'name' => 'Sesi Ujian',
                    'route' => 'menu-ujian/sesi-ujian',
                    'permission_name' => 'sesi-ujian.index',
                    'menu_group_id' => 8,
                ],
                [
                    'name' => 'Laporan Nilai',
                    'route' => 'menu-ujian/laporan-nilai',
                    'permission_name' => 'laporan-nilai.index',
                    'menu_group_id' => 8,
                ],
                // [
                //     'name' => 'Menu Group',
                //     'route' => 'menu-management/menu-group',
                //     'permission_name' => 'menu-group.index',
                //     'menu_group_id' => 9,
                // ],
                // [
                //     'name' => 'Menu Item',
                //     'route' => 'menu-management/menu-item',
                //     'permission_name' => 'menu-item.index',
                //     'menu_group_id' => 9,
                // ],
            ]
        );
    }
}
