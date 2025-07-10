<?php

namespace App\Console\Commands;

use App\Models\Profile;
use App\Models\ProfileImages;
use App\Models\User;
use App\Models\ProfileUsers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class TestPhotoAuthorization extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-photo-authorization';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test photo authorization functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up test data for photo authorization...');

        // Create two test users
        $owner = User::create([
            'first_name' => 'Profile',
            'last_name' => 'Owner',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),
        ]);

        $contributor = User::create([
            'first_name' => 'Photo',
            'last_name' => 'Contributor',
            'email' => 'contributor@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create a profile owned by the first user
        $profile = Profile::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'date_of_birth' => '1980-01-01',
            'date_of_death' => '2023-01-01',
            'user_id' => $owner->id,
        ]);

        // Give the second user access to the profile
        ProfileUsers::create([
            'profile_id' => $profile->id,
            'user_id' => $contributor->id,
            'is_owner' => false,
            'can_edit' => true,
        ]);

        // Create photos uploaded by different users
        $ownerPhoto = ProfileImages::create([
            'profile_id' => $profile->id,
            'user_id' => $owner->id,
            'path' => 'test/owner-photo.jpg',
            'caption' => 'Photo uploaded by owner',
        ]);

        $contributorPhoto = ProfileImages::create([
            'profile_id' => $profile->id,
            'user_id' => $contributor->id,
            'path' => 'test/contributor-photo.jpg',
            'caption' => 'Photo uploaded by contributor',
        ]);

        $this->info('Test data created successfully!');
        $this->info("Owner: {$owner->email} (ID: {$owner->id})");
        $this->info("Contributor: {$contributor->email} (ID: {$contributor->id})");
        $this->info("Profile: {$profile->full_name} (ID: {$profile->id})");
        $this->info("Owner Photo ID: {$ownerPhoto->id}");
        $this->info("Contributor Photo ID: {$contributorPhoto->id}");

        // Test authorization logic
        $this->info("\nTesting authorization logic...");
        
        // Test as owner
        $this->info("Testing as owner:");
        $this->info("- Can delete own photo: " . ($this->canDeletePhoto($ownerPhoto, $owner) ? 'YES' : 'NO'));
        $this->info("- Can delete contributor's photo: " . ($this->canDeletePhoto($contributorPhoto, $owner) ? 'YES' : 'NO'));
        
        // Test as contributor
        $this->info("Testing as contributor:");
        $this->info("- Can delete own photo: " . ($this->canDeletePhoto($contributorPhoto, $contributor) ? 'YES' : 'NO'));
        $this->info("- Can delete owner's photo: " . ($this->canDeletePhoto($ownerPhoto, $contributor) ? 'YES' : 'NO'));
    }

    private function canDeletePhoto($photo, $user)
    {
        // Check if user is the one who uploaded the photo
        if ($photo->user_id == $user->id) {
            return true;
        }
        
        // Check if user is the profile owner
        $profileUser = ProfileUsers::where('profile_id', $photo->profile_id)
            ->where('user_id', $user->id)
            ->first();
        
        if ($profileUser && $profileUser->is_owner) {
            return true;
        }
        
        return false;
    }
}
