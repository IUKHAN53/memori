<?php

namespace App\Console\Commands;

use App\Models\Profile;
use App\Models\ProfileVideos;
use App\Models\User;
use App\Models\ProfileUsers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class TestVideoAuthorization extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-video-authorization';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test video authorization functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🎬 Setting up test data for video authorization...');
        $this->newLine();

        // Create two test users
        $owner = User::create([
            'first_name' => 'Video',
            'last_name' => 'Owner',
            'email' => 'video-owner@example.com',
            'password' => Hash::make('password'),
        ]);

        $contributor = User::create([
            'first_name' => 'Video',
            'last_name' => 'Contributor',
            'email' => 'video-contributor@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create a profile owned by the first user
        $profile = Profile::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'date_of_birth' => '1985-01-01',
            'date_of_death' => '2024-01-01',
            'user_id' => $owner->id,
        ]);

        // Give the second user access to the profile
        ProfileUsers::create([
            'profile_id' => $profile->id,
            'user_id' => $contributor->id,
            'is_owner' => false,
            'can_edit' => true,
        ]);

        // Create videos uploaded by different users
        $ownerVideo = ProfileVideos::create([
            'profile_id' => $profile->id,
            'user_id' => $owner->id,
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'title' => 'Video uploaded by owner',
            'description' => 'Test video uploaded by profile owner',
        ]);

        $contributorVideo = ProfileVideos::create([
            'profile_id' => $profile->id,
            'user_id' => $contributor->id,
            'url' => 'https://www.youtube.com/watch?v=J---aiyznGQ',
            'title' => 'Video uploaded by contributor',
            'description' => 'Test video uploaded by contributor',
        ]);

        $this->info('Test data created successfully!');
        $this->info("Owner: {$owner->email} (ID: {$owner->id})");
        $this->info("Contributor: {$contributor->email} (ID: {$contributor->id})");
        $this->info("Profile: {$profile->full_name} (ID: {$profile->id})");
        $this->info("Owner Video ID: {$ownerVideo->id}");
        $this->info("Contributor Video ID: {$contributorVideo->id}");

        // Test authorization logic
        $this->newLine();
        $this->info("🔐 Testing authorization logic...");
        
        // Test as owner
        $this->info("Testing as owner:");
        $this->info("- Can delete own video: " . ($this->canDeleteVideo($ownerVideo, $owner, $profile) ? 'YES' : 'NO'));
        $this->info("- Can delete contributor's video: " . ($this->canDeleteVideo($contributorVideo, $owner, $profile) ? 'YES' : 'NO'));
        
        // Test as contributor
        $this->info("Testing as contributor:");
        $this->info("- Can delete own video: " . ($this->canDeleteVideo($contributorVideo, $contributor, $profile) ? 'YES' : 'NO'));
        $this->info("- Can delete owner's video: " . ($this->canDeleteVideo($ownerVideo, $contributor, $profile) ? 'YES' : 'NO'));

        $this->newLine();
        $this->info('✅ Video authorization test completed!');
    }

    private function canDeleteVideo($video, $user, $profile)
    {
        // Check if user is the one who uploaded the video
        if ($video->user_id == $user->id) {
            return true;
        }
        
        // Check if user is the profile owner
        $profileUser = ProfileUsers::where('profile_id', $profile->id)
            ->where('user_id', $user->id)
            ->first();
        
        if ($profileUser && $profileUser->is_owner) {
            return true;
        }
        
        return false;
    }
}
