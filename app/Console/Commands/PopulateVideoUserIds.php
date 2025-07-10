<?php

namespace App\Console\Commands;

use App\Models\ProfileVideos;
use App\Models\Profile;
use App\Models\ProfileUsers;
use Illuminate\Console\Command;

class PopulateVideoUserIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'videos:populate-user-ids {--dry-run : Show what would be updated without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate user_id field in profile_videos table based on profile owner';

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
            $this->info('🚀 Populating user_id field in profile_videos table...');
            $this->newLine();
        }

        // Get all videos and their status
        $allVideos = ProfileVideos::with('profile')->get();
        $videosWithoutUserId = $allVideos->whereNull('user_id');
        $videosWithUserId = $allVideos->whereNotNull('user_id');

        $this->info("📊 Video Statistics:");
        $this->info("   - Total videos: {$allVideos->count()}");
        $this->info("   - Videos with user_id: {$videosWithUserId->count()}");
        $this->info("   - Videos without user_id: {$videosWithoutUserId->count()}");
        $this->newLine();

        if ($videosWithoutUserId->isEmpty()) {
            $this->info('✅ All videos already have user_id populated!');
            return 0;
        }

        $this->info("🔧 Processing {$videosWithoutUserId->count()} videos without user_id...");
        $this->newLine();

        $updated = 0;
        $skipped = 0;
        $issues = [];

        $progressBar = $this->output->createProgressBar($videosWithoutUserId->count());
        $progressBar->start();

        foreach ($videosWithoutUserId as $video) {
            $progressBar->advance();

            // Get the profile owner's user_id
            $profile = $video->profile;
            
            if (!$profile) {
                $issues[] = "Video ID {$video->id} has no associated profile";
                $skipped++;
                continue;
            }

            if (!$profile->user_id) {
                $issues[] = "Profile ID {$profile->id} ('{$profile->full_name}') has no user_id - video ID {$video->id}";
                $skipped++;
                continue;
            }

            if (!$dryRun) {
                $video->update(['user_id' => $profile->user_id]);
            }
            
            $updated++;
        }

        $progressBar->finish();
        $this->newLine(2);

        // Report results
        if ($dryRun) {
            $this->info("🔍 Dry run completed:");
            $this->info("   - Would update: {$updated} videos");
            $this->info("   - Would skip: {$skipped} videos");
            $this->newLine();
            $this->info("Run without --dry-run to apply changes");
        } else {
            $this->info("✅ Operation completed:");
            $this->info("   - Updated: {$updated} videos");
            $this->info("   - Skipped: {$skipped} videos");
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
