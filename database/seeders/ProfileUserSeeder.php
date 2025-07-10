<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\ProfileUsers;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get specific users and profiles
        $profileOwner = User::where('email', 'john@example.com')->first();
        $contributor = User::where('email', 'jane@example.com')->first();
        $familyMember = User::where('email', 'michael@example.com')->first();

        $robertProfile = Profile::where('first_name', 'Robert')->where('last_name', 'Smith')->first();
        $maryProfile = Profile::where('first_name', 'Mary')->where('last_name', 'Johnson')->first();
        $davidProfile = Profile::where('first_name', 'David')->where('last_name', 'Wilson')->first();

        if ($robertProfile) {
            // Profile owner already has access via Profile::booted() method
            // Add contributor access to Robert's profile
            ProfileUsers::create([
                'profile_id' => $robertProfile->id,
                'user_id' => $contributor->id,
                'is_owner' => false,
                'can_edit' => true,
            ]);

            // Add family member access to Robert's profile
            ProfileUsers::create([
                'profile_id' => $robertProfile->id,
                'user_id' => $familyMember->id,
                'is_owner' => false,
                'can_edit' => true,
            ]);
        }

        if ($maryProfile) {
            // Add profile owner access to Mary's profile
            ProfileUsers::create([
                'profile_id' => $maryProfile->id,
                'user_id' => $profileOwner->id,
                'is_owner' => false,
                'can_edit' => true,
            ]);

            // Add family member access to Mary's profile
            ProfileUsers::create([
                'profile_id' => $maryProfile->id,
                'user_id' => $familyMember->id,
                'is_owner' => false,
                'can_edit' => false, // View only access
            ]);
        }

        if ($davidProfile) {
            // Add contributor access to David's profile
            ProfileUsers::create([
                'profile_id' => $davidProfile->id,
                'user_id' => $contributor->id,
                'is_owner' => false,
                'can_edit' => true,
            ]);
        }

        // Add random access to other profiles
        $otherProfiles = Profile::whereNotIn('id', [
            $robertProfile?->id,
            $maryProfile?->id,
            $davidProfile?->id
        ])->get();

        $allUsers = User::where('role', 'user')->get();

        foreach ($otherProfiles as $profile) {
            // Give random users access to profiles
            $randomUsers = $allUsers->random(rand(1, 3));
            
            foreach ($randomUsers as $user) {
                if (!ProfileUsers::where('profile_id', $profile->id)
                    ->where('user_id', $user->id)
                    ->exists()) {
                    ProfileUsers::create([
                        'profile_id' => $profile->id,
                        'user_id' => $user->id,
                        'is_owner' => false,
                        'can_edit' => fake()->boolean(70),
                    ]);
                }
            }
        }
    }
}
