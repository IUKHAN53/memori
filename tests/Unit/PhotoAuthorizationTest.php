<?php

namespace Tests\Unit;

use App\Livewire\Account\Photos;
use App\Models\Profile;
use App\Models\ProfileImages;
use App\Models\ProfileUsers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class PhotoAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_delete_any_photo()
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

        // Create photos
        $contributorPhoto = ProfileImages::create([
            'profile_id' => $profile->id,
            'user_id' => $contributor->id,
            'path' => 'test/contributor-photo.jpg',
            'caption' => 'Photo by contributor',
        ]);

        // Test as owner
        $this->actingAs($owner);

        $component = Livewire::test(Photos::class, ['profile' => $profile]);
        
        // Owner should be able to delete contributor's photo
        $this->assertTrue($component->instance()->canDeletePhoto($contributorPhoto));
    }

    public function test_contributor_can_only_delete_own_photos()
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

        // Create photos
        $ownerPhoto = ProfileImages::create([
            'profile_id' => $profile->id,
            'user_id' => $owner->id,
            'path' => 'test/owner-photo.jpg',
            'caption' => 'Photo by owner',
        ]);

        $contributorPhoto = ProfileImages::create([
            'profile_id' => $profile->id,
            'user_id' => $contributor->id,
            'path' => 'test/contributor-photo.jpg',
            'caption' => 'Photo by contributor',
        ]);

        // Test as contributor
        $this->actingAs($contributor);

        $component = Livewire::test(Photos::class, ['profile' => $profile]);
        
        // Contributor should be able to delete own photo
        $this->assertTrue($component->instance()->canDeletePhoto($contributorPhoto));
        
        // Contributor should NOT be able to delete owner's photo
        $this->assertFalse($component->instance()->canDeletePhoto($ownerPhoto));
    }

    public function test_unauthorized_user_cannot_delete_photos()
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

        // Create photo
        $photo = ProfileImages::create([
            'profile_id' => $profile->id,
            'user_id' => $owner->id,
            'path' => 'test/owner-photo.jpg',
            'caption' => 'Photo by owner',
        ]);

        // Test as unauthorized user
        $this->actingAs($unauthorized);

        $component = Livewire::test(Photos::class, ['profile' => $profile]);
        
        // Unauthorized user should NOT be able to delete photo
        $this->assertFalse($component->instance()->canDeletePhoto($photo));
    }
}
