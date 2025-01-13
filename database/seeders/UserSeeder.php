<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'user_id' => 1,
                'fullname' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'password' => Hash::make('budi123'), // Example password
                'is_admin' => 1,
            ],
            [
                'user_id' => 2,
                'fullname' => 'Siti Aisyah',
                'email' => 'siti.aisyah@example.com',
                'password' => Hash::make('siti123'),
                'is_admin' => 0,
            ],
            [
                'user_id' => 3,
                'fullname' => 'Andi Pratama',
                'email' => 'andi.pratama@example.com',
                'password' => Hash::make('andi123'),
                'is_admin' => 0,
            ],
            [
                'user_id' => 4,
                'fullname' => 'Dewi Lestari',
                'email' => 'dewi.lestari@example.com',
                'password' => Hash::make('dewi123'),
                'is_admin' => 1,
            ],
            [
                'user_id' => 5,
                'fullname' => 'Joko Widodo',
                'email' => 'joko.widodo@example.com',
                'password' => Hash::make('joko123'),
                'is_admin' => 0,
            ],
        ];

        foreach ($user as $user) {
            User::create($user);
        }
    }
}
