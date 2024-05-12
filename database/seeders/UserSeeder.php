<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "SuperAdmin",
            'email' => "superadmin@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => "Admin BIDIKSIBA",
            'email' => "bidiksiba@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => "Calon Mahasiswa",
            'email' => "siswa@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => "Pengwas",
            'email' => "pengawas@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        // User::create([
        //     'name' => "CalonMahasiswa",
        //     'email' => "user@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Angel",
        //     'email' => "angel@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Wawan",
        //     'email' => "wawan@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Nadya",
        //     'email' => "nadya@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Naila",
        //     'email' => "naila@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Faifa",
        //     'email' => "faifa@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::factory()->count(10)->create();
    }
}
