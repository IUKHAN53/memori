<?php

namespace Tests\Unit;

use App\Livewire\Account\Videos;
use App\Models\Profile;
use App\Models\ProfileVideos;
use App\Models\ProfileUsers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class VideoAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_delete_any_video()
    {
        // Create owner and contributor
        $owner = User::create([
            'first_name' => 'Owner',
            'last_name' => 'User',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),
        ]);

        $contributor = User::create([
            'first_name' => 'Contributor',
            'last_name' => 'User',
            'email' => 'contributor@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create profile
        $profile = Profile::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'date_of_birth' => '1980-01-01',
            'date_of_death' => '2023-01-01',
            'user_id' => $owner->id,
        ]);

        // Add contributor to profile
        ProfileUsers::create([
            'profile_id' => $profile->id,
            'user_id' => $contributor->id,
            'is_owner' => false,
            'can_edit' => true,
        ]);

        // Create video
        $contributorVideo = ProfileVideos::create([
            'profile_id' => $profile->id,
            'user_id' => $contributor->id,
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'title' => 'Video by contributor',
            'description' => 'Test video',
        ]);

        // Test as owner
        $this->actingAs($owner);

        $component = Livewire::test(Videos::class, ['profile' => $profile]);
        
        // Owner should be able to delete contributor's video
        $this->assertTrue($component->instance()->canDeleteVideo($contributorVideo));
    }

    public function test_contributor_with_edit_permissions_can_delete_any_video()
    {
        // Create owner and contributor
        $owner = User::create([
            'first_name' => 'Owner',
            'last_name' => 'User',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),
        ]);

        $contributor = User::create([
            'first_name' => 'Contributor',
            'last_name' => 'User',
            'email' => 'contributor@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create profile
        $profile = Profile::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'date_of_birth' => '1980-01-01',
            'date_of_death' => '2023-01-01',
            'user_id' => $owner->id,
        ]);

        // Add contributor to profile
        ProfileUsers::create([
            'profile_id' => $profile->id,
            'user_id' => $contributor->id,
            'is_owner' => false,
            'can_edit' => true,
        ]);

        // Create videos
        $ownerVideo = ProfileVideos::create([
            'profile_id' => $profile->id,
            'user_id' => $owner->id,
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'title' => 'Video by owner',
            'description' => 'Test video',
        ]);

        $contributorVideo = ProfileVideos::create([
            'profile_id' => $profile->id,
            'user_id' => $contributor->id,
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'title' => 'Video by contributor',
            'description' => 'Test video',
        ]);

        // Test as contributor
        $this->actingAs($contributor);

        $component = Livewire::test(Videos::class, ['profile' => $profile]);
        
        // Contributor should be able to delete own video
        $this->assertTrue($component->instance()->canDeleteVideo($contributorVideo));
        
        // Contributor with edit permissions should be able to delete owner's video
        $this->assertTrue($component->instance()->canDeleteVideo($ownerVideo));
    }

    public function test_unauthorized_user_cannot_delete_videos()
    {
        // Create users
        $owner = User::create([
            'first_name' => 'Owner',
            'last_name' => 'User',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),
        ]);

        $unauthorized = User::create([
            'first_name' => 'Unauthorized',
            'last_name' => 'User',
            'email' => 'unauthorized@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create profile
        $profile = Profile::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'date_of_birth' => '1980-01-01',
            'date_of_death' => '2023-01-01',
            'user_id' => $owner->id,
        ]);

        // Create video
        $video = ProfileVideos::create([
            'profile_id' => $profile->id,
            'user_id' => $owner->id,
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'title' => 'Video by owner',
            'description' => 'Test video',
        ]);

        // Test as unauthorized user
        $this->actingAs($unauthorized);

        $component = Livewire::test(Videos::class, ['profile' => $profile]);
        
        // Unauthorized user should NOT be able to delete video
        $this->assertFalse($component->instance()->canDeleteVideo($video));
    }
}
