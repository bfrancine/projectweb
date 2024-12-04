<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '1234567890',
            'address' => 'Admin Address',
            'country' => 'Costa Rica',
        ]);

        // Create a test operator
        User::create([
            'first_name' => 'Operator',
            'last_name' => 'User',
            'email' => 'operator@example.com',
            'password' => Hash::make('password'),
            'role' => 'operator',
            'phone' => '0987654321',
            'address' => 'Operator Address',
            'country' => 'Costa Rica',
        ]);

        // Create a test friend
        User::create([
            'first_name' => 'Friend',
            'last_name' => 'User',
            'email' => 'friend@example.com',
            'password' => Hash::make('password'),
            'role' => 'friend',
            'phone' => '0987654354',
            'address' => 'Friend Address',
            'country' => 'Costa Rica',
        ]);
    }
}
