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
            'name' => "Siswa A",
            'email' => "siswa01@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        // User::create([
        //     'name' => "Siswa B",
        //     'email' => "siswa02@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa C",
        //     'email' => "siswa03@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa D",
        //     'email' => "siswa04@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa E",
        //     'email' => "siswa05@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa F",
        //     'email' => "siswa06@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa G",
        //     'email' => "siswa07@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa H",
        //     'email' => "siswa08@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa I",
        //     'email' => "siswa09@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa J",
        //     'email' => "siswa10@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa K",
        //     'email' => "siswa11@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa L",
        //     'email' => "siswa12@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa M",
        //     'email' => "siswa13@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa N",
        //     'email' => "siswa14@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa O",
        //     'email' => "siswa15@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa P",
        //     'email' => "siswa16@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa Q",
        //     'email' => "siswa17@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa R",
        //     'email' => "siswa18@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa S",
        //     'email' => "siswa19@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "Siswa T",
        //     'email' => "siswa20@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::factory()->count(10)->create();
    }
}
