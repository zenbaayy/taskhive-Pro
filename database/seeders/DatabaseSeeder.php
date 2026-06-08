<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // System ke single master admin profile coordinates check aur initialize karna
        User::updateOrCreate(
            ['email' => 'zainabafzal935@gmail.com'],
            [
                'name' => 'Zainab Afzal',
                'password' => Hash::make('Zainab123'),
                'role' => 'admin',
                'avatar' => null, // Default initial value
            ]
        );
    }
}