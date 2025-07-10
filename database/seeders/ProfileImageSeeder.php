<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\ProfileImages;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileImageSeeder extends Seeder
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

        // Create photos for Robert's profile
        if ($robertProfile) {
            // Photos uploaded by profile owner
            ProfileImages::create([
                'profile_id' => $robertProfile->id,
                'user_id' => $profileOwner->id,
                'path' => 'profile-images/robert-graduation.jpg',
                'caption' => 'Robert\'s graduation from medical school',
            ]);

            ProfileImages::create([
                'profile_id' => $robertProfile->id,
                'user_id' => $profileOwner->id,
                'path' => 'profile-images/robert-family.jpg',
                'caption' => 'Family vacation at the beach',
            ]);

            // Photos uploaded by contributor
            ProfileImages::create([
                'profile_id' => $robertProfile->id,
                'user_id' => $contributor->id,
                'path' => 'profile-images/robert-hospital.jpg',
                'caption' => 'Dr. Smith at the hospital',
            ]);

            ProfileImages::create([
                'profile_id' => $robertProfile->id,
                'user_id' => $contributor->id,
                'path' => 'profile-images/robert-charity.jpg',
                'caption' => 'Volunteering at the local charity event',
            ]);

            // Photos uploaded by family member
            ProfileImages::create([
                'profile_id' => $robertProfile->id,
                'user_id' => $familyMember->id,
                'path' => 'profile-images/robert-birthday.jpg',
                'caption' => 'Robert\'s 65th birthday celebration',
            ]);
        }

        // Create photos for Mary's profile
        if ($maryProfile) {
            // Photos uploaded by profile owner (Mary's profile owner)
            ProfileImages::create([
                'profile_id' => $maryProfile->id,
                'user_id' => $contributor->id, // Mary's profile is owned by contributor
                'path' => 'profile-images/mary-classroom.jpg',
                'caption' => 'Mary in her classroom',
            ]);

            ProfileImages::create([
                'profile_id' => $maryProfile->id,
                'user_id' => $contributor->id,
                'path' => 'profile-images/mary-students.jpg',
                'caption' => 'With her beloved students',
            ]);

            // Photos uploaded by others
            ProfileImages::create([
                'profile_id' => $maryProfile->id,
                'user_id' => $profileOwner->id,
                'path' => 'profile-images/mary-retirement.jpg',
                'caption' => 'Mary\'s retirement party',
            ]);

            ProfileImages::create([
                'profile_id' => $maryProfile->id,
                'user_id' => $familyMember->id,
                'path' => 'profile-images/mary-grandchildren.jpg',
                'caption' => 'Mary with her grandchildren',
            ]);
        }

        // Create photos for David's profile
        if ($davidProfile) {
            // Photos uploaded by profile owner (David's profile owner)
            ProfileImages::create([
                'profile_id' => $davidProfile->id,
                'user_id' => $familyMember->id, // David's profile is owned by family member
                'path' => 'profile-images/david-hiking.jpg',
                'caption' => 'David on his favorite hiking trail',
            ]);

            ProfileImages::create([
                'profile_id' => $davidProfile->id,
                'user_id' => $familyMember->id,
                'path' => 'profile-images/david-friends.jpg',
                'caption' => 'David with his college friends',
            ]);

            // Photos uploaded by contributor
            ProfileImages::create([
                'profile_id' => $davidProfile->id,
                'user_id' => $contributor->id,
                'path' => 'profile-images/david-work.jpg',
                'caption' => 'David at his workplace',
            ]);
        }

        // Create random photos for other profiles
        $otherProfiles = Profile::whereNotIn('id', [
            $robertProfile?->id,
            $maryProfile?->id,
            $davidProfile?->id
        ])->get();

        $allUsers = User::where('role', 'user')->get();

        foreach ($otherProfiles as $profile) {
            $photoCount = fake()->numberBetween(1, 5);
            
            for ($i = 0; $i < $photoCount; $i++) {
                ProfileImages::create([
                    'profile_id' => $profile->id,
                    'user_id' => $allUsers->random()->id,
                    'path' => 'profile-images/' . fake()->uuid() . '.jpg',
                    'caption' => fake()->sentence(),
                ]);
            }
        }
    }
}
