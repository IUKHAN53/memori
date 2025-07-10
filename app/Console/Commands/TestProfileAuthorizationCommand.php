<?php

namespace App\Console\Commands;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class TestProfileAuthorizationCommand extends Command
{
    protected $signature = 'test:profile-authorization';
    protected $description = 'Test profile authorization logic';

    public function handle()
    {
        $this->info('Testing Profile Authorization Logic...');

        // Get test users
        $profileOwner = User::where('email', 'john@example.com')->first();
        $contributor = User::where('email', 'jane@example.com')->first();
        $familyMember = User::where('email', 'michael@example.com')->first();

        if (!$profileOwner || !$contributor || !$familyMember) {
            $this->error('Test users not found. Please run database seeders first.');
            return 1;
        }

        // Get test profile
        $profile = Profile::where('first_name', 'Robert')->where('last_name', 'Smith')->first();
        if (!$profile) {
            $this->error('Test profile not found. Please run database seeders first.');
            return 1;
        }

        $this->info("Testing authorization for profile: {$profile->full_name}");

        // Test 1: Profile owner should be able to edit
        Auth::login($profileOwner);
        $canEdit = $profile->canEdit();
        $this->info("Profile owner can edit: " . ($canEdit ? 'YES' : 'NO'));

        // Test 2: Contributor with edit permissions should be able to edit
        Auth::login($contributor);
        $canEdit = $profile->canEdit();
        $this->info("Contributor can edit: " . ($canEdit ? 'YES' : 'NO'));

        // Test 3: Family member with edit permissions should be able to edit
        Auth::login($familyMember);
        $canEdit = $profile->canEdit();
        $this->info("Family member can edit: " . ($canEdit ? 'YES' : 'NO'));

        // Test 4: Check profile users and their permissions
        $this->info("\nProfile users and permissions:");
        foreach ($profile->profileUsers as $profileUser) {
            $this->info("- User: {$profileUser->user->first_name} {$profileUser->user->last_name} | Is Owner: " . ($profileUser->is_owner ? 'YES' : 'NO') . " | Can Edit: " . ($profileUser->can_edit ? 'YES' : 'NO'));
        }

        $this->info("\nProfile authorization test completed successfully!");
        return 0;
    }
}
