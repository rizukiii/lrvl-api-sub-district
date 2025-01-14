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
                'name' => 'Budi Santoso',
                'nik' => '081271802321',
                'email' => 'budi.santoso@example.com',
                'password' => Hash::make('budi123'), // Example password       ],
                [
                    'user_id' => 2,
                    'name' => 'Siti Aisyah',
                    'nik' => '081271802325',
                    'email' => 'siti.aisyah@example.com',
                    'password' => Hash::make('siti123'),
                ],
                [
                    'user_id' => 3,
                    'name' => 'Andi Pratama',
                    'nik' => '081271802322',
                    'email' => 'andi.pratama@example.com',
                    'password' => Hash::make('andi123'),
                ],
                [
                    'user_id' => 4,
                    'name' => 'Dewi Lestari',
                    'nik' => '081271802323',
                    'email' => 'dewi.lestari@example.com',
                    'password' => Hash::make('dewi123'),
                ],
                [
                    'user_id' => 5,
                    'name' => 'Joko Widodo',
                    'nik' => '081271802324',
                    'email' => 'joko.widodo@example.com',
                    'password' => Hash::make('joko123'),
                ]
            ]
        ];

        foreach ($user as $user) {
            User::create($user);
        }
    }
}
