<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            // Superadmin
            [
                'name' => 'Super Admin 1',
                'email' => 'superadmin1@gmail.com',
                'role' => 'superadmin',
            ],
            [
                'name' => 'Super Admin 2',
                'email' => 'superadmin2@gmail.com',
                'role' => 'superadmin',
            ],
            [
                'name' => 'Super Admin 3',
                'email' => 'superadmin3@gmail.com',
                'role' => 'superadmin',
            ],
            [
                'name' => 'Super Admin 4',
                'email' => 'superadmin4@gmail.com',
                'role' => 'superadmin',
            ],
            [
                'name' => 'Super Admin 5',
                'email' => 'superadmin5@gmail.com',
                'role' => 'superadmin',
            ],

            // Admin
            [
                'name' => 'Admin 1',
                'email' => 'admin1@gmail.com',
                'role' => 'admin',
            ],
            [
                'name' => 'Admin 2',
                'email' => 'admin2@gmail.com',
                'role' => 'admin',
            ],
            [
                'name' => 'Admin 3',
                'email' => 'admin3@gmail.com',
                'role' => 'admin',
            ],
            [
                'name' => 'Admin 4',
                'email' => 'admin4@gmail.com',
                'role' => 'admin',
            ],
            [
                'name' => 'Admin 5',
                'email' => 'admin5@gmail.com',
                'role' => 'admin',
            ],

            // User
            [
                'name' => 'User 1',
                'email' => 'user1@gmail.com',
                'role' => 'user',
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@gmail.com',
                'role' => 'user',
            ],
            [
                'name' => 'User 3',
                'email' => 'user3@gmail.com',
                'role' => 'user',
            ],
            [
                'name' => 'User 4',
                'email' => 'user4@gmail.com',
                'role' => 'user',
            ],
            [
                'name' => 'User 5',
                'email' => 'user5@gmail.com',
                'role' => 'user',
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
