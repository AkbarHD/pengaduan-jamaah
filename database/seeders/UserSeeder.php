<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'adam@gmail.com'],
            [
                'name' => 'Adam',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'babil@gmail.com'],
            [
                'name' => 'Babil',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }
}
