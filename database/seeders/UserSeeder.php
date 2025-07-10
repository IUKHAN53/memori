<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@memori.com',
            'password' => Hash::make('memori@123'),
            'role' => 'admin',
            'city' => 'New York',
            'country' => 'USA',
            'email_verified_at' => now(),
        ]);

        // Create profile owner
        User::create([
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'city' => 'Los Angeles',
            'country' => 'USA',
            'email_verified_at' => now(),
        ]);

        // Create profile contributor
        User::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'city' => 'Chicago',
            'country' => 'USA',
            'email_verified_at' => now(),
        ]);

        // Create family member
        User::create([
            'first_name' => 'Michael',
            'last_name' => 'Johnson',
            'email' => 'michael@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'city' => 'Miami',
            'country' => 'USA',
            'email_verified_at' => now(),
        ]);

        // Create regular users
        User::factory(10)->create();
    }
}
