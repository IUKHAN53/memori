<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get specific users
        $profileOwner = User::where('email', 'john@example.com')->first();
        $contributor = User::where('email', 'jane@example.com')->first();
        $familyMember = User::where('email', 'michael@example.com')->first();

        // Create memorial profile for a deceased person
        Profile::create([
            'first_name' => 'Robert',
            'middle_name' => 'James',
            'last_name' => 'Smith',
            'title' => 'Dr.',
            'relationship' => 'Father',
            'picture' => 'profiles/robert-smith.jpg',
            'cover_photo' => 'profiles/covers/robert-smith-cover.jpg',
            'city' => 'Boston',
            'state' => 'Massachusetts',
            'obituary_link' => 'https://example.com/obituary/robert-smith',
            'bio' => 'Dr. Robert James Smith was a loving father, dedicated physician, and pillar of the community. He touched countless lives through his medical practice and volunteer work. His legacy of compassion and service will live on in the hearts of all who knew him.',
            'heading_text' => 'In loving memory of a wonderful father and doctor',
            'include_heading_text' => true,
            'quote_text' => 'The good die young, but their memory lives forever.',
            'date_of_birth' => '1955-03-15',
            'date_of_death' => '2023-08-22',
            'cemetery_name' => 'Peaceful Gardens Cemetery',
            'cemetery_plot' => 'Section A, Plot 125',
            'cemetery_city' => 'Boston',
            'cemetery_state' => 'Massachusetts',
            'cemetery_lat' => '42.3601',
            'cemetery_lng' => '-71.0589',
            'donations_url' => 'https://example.com/donations/robert-smith',
            'is_public' => true,
            'user_id' => $profileOwner->id,
        ]);

        // Create another memorial profile
        Profile::create([
            'first_name' => 'Mary',
            'middle_name' => 'Elizabeth',
            'last_name' => 'Johnson',
            'title' => 'Mrs.',
            'relationship' => 'Mother',
            'picture' => 'profiles/mary-johnson.jpg',
            'cover_photo' => 'profiles/covers/mary-johnson-cover.jpg',
            'city' => 'Seattle',
            'state' => 'Washington',
            'obituary_link' => 'https://example.com/obituary/mary-johnson',
            'bio' => 'Mary Elizabeth Johnson was a beloved mother, grandmother, and teacher. She dedicated her life to education and nurturing young minds. Her warmth, wisdom, and infectious smile brought joy to everyone around her.',
            'heading_text' => 'Celebrating the life of our beloved mother and teacher',
            'include_heading_text' => true,
            'quote_text' => 'A teacher affects eternity; she can never tell where her influence stops.',
            'date_of_birth' => '1948-11-08',
            'date_of_death' => '2023-12-15',
            'cemetery_name' => 'Evergreen Memorial Park',
            'cemetery_plot' => 'Section B, Plot 78',
            'cemetery_city' => 'Seattle',
            'cemetery_state' => 'Washington',
            'cemetery_lat' => '47.6062',
            'cemetery_lng' => '-122.3321',
            'donations_url' => 'https://example.com/donations/mary-johnson',
            'is_public' => true,
            'user_id' => $contributor->id,
        ]);

        // Create private profile
        Profile::create([
            'first_name' => 'David',
            'middle_name' => 'Andrew',
            'last_name' => 'Wilson',
            'title' => 'Mr.',
            'relationship' => 'Brother',
            'picture' => 'profiles/david-wilson.jpg',
            'city' => 'Portland',
            'state' => 'Oregon',
            'bio' => 'David Andrew Wilson was a devoted brother and friend. He lived life to the fullest and brought laughter wherever he went.',
            'heading_text' => 'In memory of David Wilson',
            'include_heading_text' => true,
            'quote_text' => 'Life is not measured by the number of breaths we take, but by the moments that take our breath away.',
            'date_of_birth' => '1982-07-12',
            'date_of_death' => '2023-05-30',
            'cemetery_name' => 'Rose City Cemetery',
            'cemetery_plot' => 'Section C, Plot 45',
            'cemetery_city' => 'Portland',
            'cemetery_state' => 'Oregon',
            'cemetery_lat' => '45.5152',
            'cemetery_lng' => '-122.6784',
            'is_public' => false,
            'user_id' => $familyMember->id,
        ]);

        // Create additional profiles using factory
        Profile::factory(5)->create();
    }
}
