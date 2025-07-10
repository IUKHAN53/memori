<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\ProfileTributes;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileTributeSeeder extends Seeder
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

        // Create tributes for Robert's profile
        if ($robertProfile) {
            ProfileTributes::create([
                'profile_id' => $robertProfile->id,
                'user_id' => $profileOwner->id,
                'title' => 'A Father\'s Love',
                'tribute' => 'Dad was not just my father, but my hero. He taught me the value of hard work, compassion, and always helping others. His dedication to his patients and family was unwavering. Even in his final days, he was thinking of others. I will miss his wisdom, his laugh, and his warm hugs. Rest in peace, Dad.',
                'likes' => 23,
            ]);

            ProfileTributes::create([
                'profile_id' => $robertProfile->id,
                'user_id' => $contributor->id,
                'title' => 'A Devoted Doctor',
                'tribute' => 'Dr. Smith was more than a physician; he was a healer in every sense of the word. His patients trusted him completely, and he never let them down. He had a gift for making everyone feel heard and cared for. The medical community has lost a giant, but his legacy will live on in all the lives he touched.',
                'likes' => 18,
            ]);

            ProfileTributes::create([
                'profile_id' => $robertProfile->id,
                'user_id' => $familyMember->id,
                'title' => 'Uncle Robert\'s Wisdom',
                'tribute' => 'Uncle Robert always had the best advice. He was the one we turned to when life got difficult. His calm demeanor and wise words could solve any problem. He taught me that success is not measured by what you have, but by how many people you help along the way.',
                'likes' => 15,
            ]);
        }

        // Create tributes for Mary's profile
        if ($maryProfile) {
            ProfileTributes::create([
                'profile_id' => $maryProfile->id,
                'user_id' => $contributor->id,
                'title' => 'My Beloved Mother',
                'tribute' => 'Mom was the heart of our family. She showed us what unconditional love looks like. Her strength, grace, and endless patience shaped who I am today. She dedicated her life to teaching and nurturing not just her students, but everyone around her. Her legacy of love will continue through all of us.',
                'likes' => 31,
            ]);

            ProfileTributes::create([
                'profile_id' => $maryProfile->id,
                'user_id' => $profileOwner->id,
                'title' => 'A Teacher Who Changed Lives',
                'tribute' => 'Mrs. Johnson was my third-grade teacher, and she changed my life. She saw potential in every student and never gave up on anyone. Her classroom was a place of wonder and learning. Even decades later, I still remember her lessons - not just about math and reading, but about kindness and perseverance.',
                'likes' => 27,
            ]);

            ProfileTributes::create([
                'profile_id' => $maryProfile->id,
                'user_id' => $familyMember->id,
                'title' => 'Grandma Mary\'s Love',
                'tribute' => 'Grandma Mary was magic. She could turn any ordinary day into an adventure. Her stories, her cookies, and her endless hugs made childhood wonderful. She taught me that every person has value and deserves to be treated with respect and kindness.',
                'likes' => 19,
            ]);
        }

        // Create tributes for David's profile
        if ($davidProfile) {
            ProfileTributes::create([
                'profile_id' => $davidProfile->id,
                'user_id' => $familyMember->id,
                'title' => 'My Brother, My Friend',
                'tribute' => 'David was not just my brother, he was my best friend. We shared everything - dreams, fears, laughter, and tears. He had this incredible ability to make everyone feel special. His smile could light up a room, and his laughter was contagious. I will miss him every day.',
                'likes' => 12,
            ]);

            ProfileTributes::create([
                'profile_id' => $davidProfile->id,
                'user_id' => $contributor->id,
                'title' => 'A True Friend',
                'tribute' => 'David was the friend everyone wishes they had. He was loyal, funny, and always there when you needed him. He taught me that life is meant to be lived fully and that every moment is precious. His spirit will live on in all the memories we shared.',
                'likes' => 8,
            ]);
        }

        // Create random tributes for other profiles
        $otherProfiles = Profile::whereNotIn('id', [
            $robertProfile?->id,
            $maryProfile?->id,
            $davidProfile?->id
        ])->get();

        $allUsers = User::where('role', 'user')->get();

        foreach ($otherProfiles as $profile) {
            $tributeCount = fake()->numberBetween(1, 4);
            
            for ($i = 0; $i < $tributeCount; $i++) {
                ProfileTributes::create([
                    'profile_id' => $profile->id,
                    'user_id' => $allUsers->random()->id,
                    'title' => fake()->sentence(3),
                    'tribute' => fake()->paragraphs(fake()->numberBetween(2, 4), true),
                    'likes' => fake()->numberBetween(0, 25),
                ]);
            }
        }
    }
}
