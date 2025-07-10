<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\ProfileVideos;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileVideoSeeder extends Seeder
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

        // Create videos for Robert's profile
        if ($robertProfile) {
            // Video uploaded by profile owner
            ProfileVideos::create([
                'profile_id' => $robertProfile->id,
                'user_id' => $profileOwner->id,
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'title' => 'Dr. Robert Smith - Medical Conference Speech',
                'description' => 'Robert delivering a keynote speech at the annual medical conference.',
            ]);

            // Video uploaded by family member
            ProfileVideos::create([
                'profile_id' => $robertProfile->id,
                'user_id' => $familyMember->id,
                'url' => 'https://www.youtube.com/watch?v=J---aiyznGQ',
                'title' => 'Family Vacation Memories',
                'description' => 'A compilation of our family vacation memories with Robert.',
            ]);
        }

        // Create videos for Mary's profile
        if ($maryProfile) {
            // Video uploaded by contributor (Mary's profile is owned by contributor)
            ProfileVideos::create([
                'profile_id' => $maryProfile->id,
                'user_id' => $contributor->id,
                'url' => 'https://www.youtube.com/watch?v=kJQP7kiw5Fk',
                'title' => 'Mary Johnson - Retirement Speech',
                'description' => 'Mary\'s heartfelt retirement speech after 35 years of teaching.',
            ]);

            // Video uploaded by contributor
            ProfileVideos::create([
                'profile_id' => $maryProfile->id,
                'user_id' => $contributor->id,
                'url' => 'https://www.youtube.com/watch?v=L_jWHffIx5E',
                'title' => 'Student Tribute to Mrs. Johnson',
                'description' => 'A special video tribute from Mary\'s former students.',
            ]);
        }

        // Create videos for David's profile
        if ($davidProfile) {
            // Video uploaded by family member (David's profile is owned by family member)
            ProfileVideos::create([
                'profile_id' => $davidProfile->id,
                'user_id' => $familyMember->id,
                'url' => 'https://www.youtube.com/watch?v=hT_nvWreIhg',
                'title' => 'David\'s Mountain Climbing Adventure',
                'description' => 'David conquering his favorite mountain trail.',
            ]);
        }

        // Create random videos for other profiles
        $allUsers = User::all();
        $otherProfiles = Profile::whereNotIn('id', [
            $robertProfile?->id,
            $maryProfile?->id,
            $davidProfile?->id
        ])->get();

        foreach ($otherProfiles as $profile) {
            if (fake()->boolean(40)) { // 40% chance to have videos
                $videoCount = fake()->numberBetween(1, 3);
                
                for ($i = 0; $i < $videoCount; $i++) {
                    ProfileVideos::create([
                        'profile_id' => $profile->id,
                        'user_id' => $allUsers->random()->id,
                        'url' => 'https://www.youtube.com/watch?v=' . fake()->regexify('[A-Za-z0-9]{11}'),
                        'title' => fake()->sentence(4),
                        'description' => fake()->optional(0.7)->paragraph(),
                    ]);
                }
            }
        }
    }
}
