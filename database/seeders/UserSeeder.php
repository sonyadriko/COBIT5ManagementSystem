<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Membuat user admin
         User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',  // Atur role admin
        ]);

        // Membuat user auditor
        User::create([
            'name' => 'Auditor',
            'email' => 'auditor@gmail.com',
            'password' => Hash::make('auditor123'),
            'role' => 'auditor',  // Atur role auditor
        ]);
    }
}
