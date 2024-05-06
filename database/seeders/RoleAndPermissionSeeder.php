<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'user.management']);
        Permission::create(['name' => 'role.permission.management']);
        Permission::create(['name' => 'menu.pendidikan']);
        Permission::create(['name' => 'menu.ujian']);
        Permission::create(['name' => 'menu.kriteria.pendaftar']);
        Permission::create(['name' => 'menu.kriteria.ekonomi']);
        Permission::create(['name' => 'menu.ranking']);
        Permission::create(['name' => 'menu.management']);

        //user
        Permission::create(['name' => 'user.index']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.destroy']);

        //biodata admin
        Permission::create(['name' => 'verif-admin.index']);
        Permission::create(['name' => 'verif-admin.edit']);
        Permission::create(['name' => 'verif-admin.destroy']);
        Permission::create(['name' => 'verif-admin.export.biodata']);
        Permission::create(['name' => 'verif-admin.export.ekonomi']);
        Permission::create(['name' => 'verif-admin.export.pendaftar']);
        Permission::create(['name' => 'verif-admin.verifikasi-pendaftar.verif']);
        Permission::create(['name' => 'verif-admin.verifikasi-pendaftar.reject']);

        //akun ujian
        Permission::create(['name' => 'akun-ujian.index']);

        //role
        Permission::create(['name' => 'role.index']);
        Permission::create(['name' => 'role.create']);
        Permission::create(['name' => 'role.edit']);
        Permission::create(['name' => 'role.destroy']);
        Permission::create(['name' => 'role.import']);
        Permission::create(['name' => 'role.export']);

        //permission
        Permission::create(['name' => 'permission.index']);
        Permission::create(['name' => 'permission.create']);
        Permission::create(['name' => 'permission.edit']);
        Permission::create(['name' => 'permission.destroy']);
        Permission::create(['name' => 'permission.import']);
        Permission::create(['name' => 'permission.export']);

        //assignpermission
        Permission::create(['name' => 'assign.index']);
        Permission::create(['name' => 'assign.create']);
        Permission::create(['name' => 'assign.edit']);
        Permission::create(['name' => 'assign.destroy']);

        //assingusertorole
        Permission::create(['name' => 'assign.user.index']);
        Permission::create(['name' => 'assign.user.create']);
        Permission::create(['name' => 'assign.user.edit']);

        //bobot kriteria
        Permission::create(['name' => 'bobot-kriteria.index']);
        Permission::create(['name' => 'bobot-kriteria.edit']);

        //data ranking ekonomi
        Permission::create(['name' => 'data-ekonomi.index']);
        Permission::create(['name' => 'data-ekonomi.export.alternative']);

        //data ranking bidiksiba
        Permission::create(['name' => 'data-spk.index']);
        Permission::create(['name' => 'data-spk.export.hasil-spk']);

        //asal jurusan
        Permission::create(['name' => 'asal-jurusan.index']);
        Permission::create(['name' => 'asal-jurusan.create']);
        Permission::create(['name' => 'asal-jurusan.edit']);
        Permission::create(['name' => 'asal-jurusan.destroy']);

        //jurusan
        Permission::create(['name' => 'jurusan.index']);
        Permission::create(['name' => 'jurusan.create']);
        Permission::create(['name' => 'jurusan.edit']);
        Permission::create(['name' => 'jurusan.destroy']);

        //prodi
        Permission::create(['name' => 'prodi.index']);
        Permission::create(['name' => 'prodi.create']);
        Permission::create(['name' => 'prodi.edit']);
        Permission::create(['name' => 'prodi.destroy']);

        //soal ujian
        Permission::create(['name' => 'ujian.index']);
        Permission::create(['name' => 'ujian.create']);
        Permission::create(['name' => 'ujian.edit']);
        Permission::create(['name' => 'ujian.destroy']);
        Permission::create(['name' => 'ujian.soalUjian']);
        Permission::create(['name' => 'soal-ujian.create']);
        Permission::create(['name' => 'soal-ujian.edit']);
        Permission::create(['name' => 'soal-ujian.destroy']);
        Permission::create(['name' => 'soal-ujian.import']);

        //sesi ujian
        Permission::create(['name' => 'sesi-ujian.index']);
        Permission::create(['name' => 'sesi-ujian.create']);
        Permission::create(['name' => 'sesi-ujian.edit']);
        Permission::create(['name' => 'sesi-ujian.destroy']);
        Permission::create(['name' => 'sesi-ujian.sesiUjian']);
        Permission::create(['name' => 'sesi-user.create']);
        Permission::create(['name' => 'sesi-user.destroy']);

        //laporan nilai
        Permission::create(['name' => 'laporan-nilai.index']);
        Permission::create(['name' => 'laporan-nilai.export']);
        Permission::create(['name' => 'list-nilai.show']);

        //pekerjaan orang tua
        Permission::create(['name' => 'pekerjaan-ortu.index']);
        Permission::create(['name' => 'pekerjaan-ortu.edit']);

        //penghasilan orang tua
        Permission::create(['name' => 'penghasilan-ortu.index']);
        Permission::create(['name' => 'penghasilan-ortu.edit']);

        //kamar mandi
        Permission::create(['name' => 'kamar-mandi.index']);
        Permission::create(['name' => 'kamar-mandi.edit']);

        //tagihan listrik
        Permission::create(['name' => 'tagihan-listrik.index']);
        Permission::create(['name' => 'tagihan-listrik.edit']);

        //hutang
        Permission::create(['name' => 'hutang.index']);
        Permission::create(['name' => 'hutang.edit']);

        //saudara
        Permission::create(['name' => 'saudara.index']);
        Permission::create(['name' => 'saudara.edit']);

        //status orang tua
        Permission::create(['name' => 'status-ortu.index']);
        Permission::create(['name' => 'status-ortu.edit']);

        //menu group 
        Permission::create(['name' => 'menu-group.index']);
        Permission::create(['name' => 'menu-group.create']);
        Permission::create(['name' => 'menu-group.edit']);
        Permission::create(['name' => 'menu-group.destroy']);

        //menu item 
        Permission::create(['name' => 'menu-item.index']);
        Permission::create(['name' => 'menu-item.create']);
        Permission::create(['name' => 'menu-item.edit']);
        Permission::create(['name' => 'menu-item.destroy']);

        // create roles 
        $roleUser = Role::create(['name' => 'calon-mahasiswa']);
        $roleUser->givePermissionTo([
        ]);

        $roleUser = Role::create(['name' => 'admin-bidiksiba']);
        $roleUser->givePermissionTo([
            'dashboard',
            'user.management',
            'verif-admin.index',
            'menu.kriteria.pendaftar',
            'pekerjaan-ortu.index',
            'penghasilan-ortu.index',
            'saudara.index',
            'status-ortu.index',
            'menu.kriteria.ekonomi',
            'kamar-mandi.index',
            'tagihan-listrik.index',
            'hutang.index',
            'menu.ranking',
            'bobot-kriteria.index',
            'data-ekonomi.index',
            'data-ekonomi.export.alternative',
            'data-spk.index',
            'data-spk.export.hasil-spk',
            'menu.ujian',
            'ujian.index',
            'ujian.soalUjian',
            'sesi-ujian.index',
            'sesi-ujian.sesiUjian',
            'laporan-nilai.index',
            'laporan-nilai.export',
            'list-nilai.show'
        ]);

        $roleUser = Role::create(['name' => 'pengawas']);
        $roleUser->givePermissionTo([
        ]);

        // create Super Admin
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        //assign user id 1 ke super admin
        $user = User::find(1);
        $user->assignRole('super-admin');
        $user = User::find(2);
        $user->assignRole('admin-bidiksiba');
        $user = User::find(3);
        $user->assignRole('calon-mahasiswa');
        $user = User::find(4);
        $user->assignRole('calon-mahasiswa');
        $user = User::find(5);
        $user->assignRole('calon-mahasiswa');
        $user = User::find(6);
        $user->assignRole('calon-mahasiswa');
        $user = User::find(7);
        $user->assignRole('calon-mahasiswa');
        $user = User::find(8);
        $user->assignRole('calon-mahasiswa');
    }
}
