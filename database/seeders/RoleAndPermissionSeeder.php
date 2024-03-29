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
        Permission::create(['name' => 'menu.management']);

        //user
        Permission::create(['name' => 'user.index']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.destroy']);
        Permission::create(['name' => 'user.import']);
        Permission::create(['name' => 'user.export']);

        //biodata admin
        Permission::create(['name' => 'verif-admin.index']);
        Permission::create(['name' => 'verif-admin.edit']);
        Permission::create(['name' => 'verif-admin.destroy']);

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

        //sesi ujian
        Permission::create(['name' => 'sesi-ujian.index']);
        Permission::create(['name' => 'sesi-ujian.create']);
        Permission::create(['name' => 'sesi-ujian.edit']);
        Permission::create(['name' => 'sesi-ujian.destroy']);

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
            'dashboard',
            // 'user.management',
            // 'user.index',
        ]);

        // create Super Admin
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        //assign user id 1 ke super admin
        $user = User::find(1);
        $user->assignRole('super-admin');
        $user = User::find(2);
        $user->assignRole('calon-mahasiswa');
    }
}
