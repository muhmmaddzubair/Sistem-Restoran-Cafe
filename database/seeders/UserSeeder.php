<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Admin Cafe',  'email' => 'admin@cafe.test',  'role' => 'admin'],
            ['name' => 'Kasir Cafe',  'email' => 'kasir@cafe.test',  'role' => 'kasir'],
            ['name' => 'Waiter Cafe', 'email' => 'waiter@cafe.test', 'role' => 'waiter'],
            ['name' => 'Pelanggan', 'email' => 'pelanggan@cafe.test', 'role' => 'pelanggan'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name'      => $user['name'],
                    'role'      => $user['role'],
                    'password'  => 'password123', // otomatis di-hash oleh cast 'hashed'
                    'is_active' => true,
                ]
            );
        }
    }
}