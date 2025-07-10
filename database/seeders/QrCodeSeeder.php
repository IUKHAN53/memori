<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\QrCode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QrCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get specific profiles
        $robertProfile = Profile::where('first_name', 'Robert')->where('last_name', 'Smith')->first();
        $maryProfile = Profile::where('first_name', 'Mary')->where('last_name', 'Johnson')->first();
        $davidProfile = Profile::where('first_name', 'David')->where('last_name', 'Wilson')->first();

        // Create QR codes for specific profiles
        if ($robertProfile) {
            QrCode::create([
                'identifier' => 'MEM-' . Str::upper(Str::random(8)),
                'secret_phrase' => 'loving father',
                'profile_id' => $robertProfile->id,
                'path' => 'qr-codes/robert-smith-qr.png',
                'is_assigned' => true,
                'assigned_at' => now()->subDays(30),
            ]);
        }

        if ($maryProfile) {
            QrCode::create([
                'identifier' => 'MEM-' . Str::upper(Str::random(8)),
                'secret_phrase' => 'beloved teacher',
                'profile_id' => $maryProfile->id,
                'path' => 'qr-codes/mary-johnson-qr.png',
                'is_assigned' => true,
                'assigned_at' => now()->subDays(15),
            ]);
        }

        if ($davidProfile) {
            QrCode::create([
                'identifier' => 'MEM-' . Str::upper(Str::random(8)),
                'secret_phrase' => 'dear brother',
                'profile_id' => $davidProfile->id,
                'path' => 'qr-codes/david-wilson-qr.png',
                'is_assigned' => true,
                'assigned_at' => now()->subDays(7),
            ]);
        }

        // Create unassigned QR codes
        for ($i = 0; $i < 10; $i++) {
            QrCode::create([
                'identifier' => 'MEM-' . Str::upper(Str::random(8)),
                'secret_phrase' => fake()->words(2, true),
                'profile_id' => null,
                'path' => null,
                'is_assigned' => false,
                'assigned_at' => null,
            ]);
        }

        // Create assigned QR codes for other profiles
        $otherProfiles = Profile::whereNotIn('id', [
            $robertProfile?->id,
            $maryProfile?->id,
            $davidProfile?->id
        ])->get();

        foreach ($otherProfiles as $profile) {
            if (fake()->boolean(70)) { // 70% chance to have QR code
                QrCode::create([
                    'identifier' => 'MEM-' . Str::upper(Str::random(8)),
                    'secret_phrase' => fake()->words(2, true),
                    'profile_id' => $profile->id,
                    'path' => 'qr-codes/' . Str::slug($profile->full_name) . '-qr.png',
                    'is_assigned' => true,
                    'assigned_at' => fake()->dateTimeBetween('-6 months', 'now'),
                ]);
            }
        }
    }
}
