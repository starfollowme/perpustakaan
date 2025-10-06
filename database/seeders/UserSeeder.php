<?php

namespace Database\Seeders;

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
        $users = [
            [
                'name' => 'Admin Perpustakaan',
                'email' => 'admin@perpus.com',
                'password' => 'password',
                'role' => 'admin',
            ],
            [
                'name' => 'Petugas Perpustakaan',
                'email' => 'petugas@perpus.com',
                'password' => 'password',
                'role' => 'admin',
            ],
            [
                'name' => 'Anggota Perpustakaan',
                'email' => 'anggota@perpus.com',
                'password' => 'password',
                'role' => 'user',
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make($data['password']),
                    'role' => $data['role'],
                ]
            );
        }
    }
}
