<?php

namespace App\Console\Commands;

use App\Models\ProfileImages;
use App\Models\Profile;
use Illuminate\Console\Command;

class PopulatePhotoUserIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:populate-user-ids {--dry-run : Show what would be updated without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate user_id field in profile_images table based on profile owner';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        
        if ($dryRun) {
            $this->info('🔍 Running in dry-run mode - no changes will be made');
            $this->newLine();
        } else {
            $this->info('🚀 Populating user_id field in profile_images table...');
            $this->newLine();
        }

        // Get all photos and their status
        $allPhotos = ProfileImages::with('profile')->get();
        $photosWithoutUserId = $allPhotos->whereNull('user_id');
        $photosWithUserId = $allPhotos->whereNotNull('user_id');

        $this->info("📊 Photo Statistics:");
        $this->info("   - Total photos: {$allPhotos->count()}");
        $this->info("   - Photos with user_id: {$photosWithUserId->count()}");
        $this->info("   - Photos without user_id: {$photosWithoutUserId->count()}");
        $this->newLine();

        if ($photosWithoutUserId->isEmpty()) {
            $this->info('✅ All photos already have user_id populated!');
            return 0;
        }

        $this->info("� Processing {$photosWithoutUserId->count()} photos without user_id...");
        $this->newLine();

        $updated = 0;
        $skipped = 0;
        $issues = [];

        $progressBar = $this->output->createProgressBar($photosWithoutUserId->count());
        $progressBar->start();

        foreach ($photosWithoutUserId as $photo) {
            $progressBar->advance();

            // Get the profile owner's user_id
            $profile = $photo->profile;
            
            if (!$profile) {
                $issues[] = "Photo ID {$photo->id} has no associated profile";
                $skipped++;
                continue;
            }

            if (!$profile->user_id) {
                $issues[] = "Profile ID {$profile->id} ('{$profile->full_name}') has no user_id - photo ID {$photo->id}";
                $skipped++;
                continue;
            }

            if (!$dryRun) {
                $photo->update(['user_id' => $profile->user_id]);
            }
            
            $updated++;
        }

        $progressBar->finish();
        $this->newLine(2);

        // Report results
        if ($dryRun) {
            $this->info("🔍 Dry run completed:");
            $this->info("   - Would update: {$updated} photos");
            $this->info("   - Would skip: {$skipped} photos");
            $this->newLine();
            $this->info("Run without --dry-run to apply changes");
        } else {
            $this->info("✅ Operation completed:");
            $this->info("   - Updated: {$updated} photos");
            $this->info("   - Skipped: {$skipped} photos");
        }

        // Show issues if any
        if (!empty($issues)) {
            $this->newLine();
            $this->warn("⚠️  Issues encountered:");
            foreach ($issues as $issue) {
                $this->warn("   - {$issue}");
            }
        }

        return 0;
    }
}
