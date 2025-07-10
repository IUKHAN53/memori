<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run seeders in order of dependencies
        $this->call([
            SiteSettingSeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,
            ProfileUserSeeder::class,
            QrCodeSeeder::class,
            ProfileImageSeeder::class,
            ProfileVideoSeeder::class,
            ProfileTributeSeeder::class,
        ]);

        $this->command->info('Database seeded successfully!');
        $this->command->info('Test credentials:');
        $this->command->info('Admin: admin@memori.com / memori@123');
        $this->command->info('User 1: john@example.com / password');
        $this->command->info('User 2: jane@example.com / password');
        $this->command->info('User 3: michael@example.com / password');
    }
}
