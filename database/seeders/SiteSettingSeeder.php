<?php

namespace Database\Seeders;

use App\Models\SiteSettings;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'Memori',
            ],
            [
                'key' => 'site_description',
                'value' => 'A digital memorial platform to honor and remember loved ones.',
            ],
            [
                'key' => 'admin_email',
                'value' => 'admin@memori.com',
            ],
            [
                'key' => 'contact_email',
                'value' => 'contact@memori.com',
            ],
            [
                'key' => 'support_email',
                'value' => 'support@memori.com',
            ],
            [
                'key' => 'site_logo',
                'value' => 'logo.png',
            ],
            [
                'key' => 'site_favicon',
                'value' => 'favicon.ico',
            ],
            [
                'key' => 'maintenance_mode',
                'value' => 'false',
            ],
            [
                'key' => 'registration_enabled',
                'value' => 'true',
            ],
            [
                'key' => 'max_photos_per_profile',
                'value' => '50',
            ],
            [
                'key' => 'max_videos_per_profile',
                'value' => '10',
            ],
            [
                'key' => 'max_file_size_mb',
                'value' => '10',
            ],
            [
                'key' => 'allowed_image_types',
                'value' => 'jpg,jpeg,png,gif',
            ],
            [
                'key' => 'qr_code_expiry_days',
                'value' => '365',
            ],
            [
                'key' => 'profile_approval_required',
                'value' => 'false',
            ],
            [
                'key' => 'smtp_host',
                'value' => 'smtp.gmail.com',
            ],
            [
                'key' => 'smtp_port',
                'value' => '587',
            ],
            [
                'key' => 'smtp_encryption',
                'value' => 'tls',
            ],
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/memori',
            ],
            [
                'key' => 'social_twitter',
                'value' => 'https://twitter.com/memori',
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/memori',
            ],
            [
                'key' => 'terms_of_service',
                'value' => 'Welcome to Memori. By using our service, you agree to these terms...',
            ],
            [
                'key' => 'privacy_policy',
                'value' => 'Your privacy is important to us. This policy explains how we collect, use, and protect your information...',
            ],
            [
                'key' => 'default_profile_visibility',
                'value' => 'public',
            ],
            [
                'key' => 'enable_tribute_notifications',
                'value' => 'true',
            ],
            [
                'key' => 'enable_photo_notifications',
                'value' => 'true',
            ],
            [
                'key' => 'enable_video_notifications',
                'value' => 'true',
            ],
            [
                'key' => 'backup_frequency',
                'value' => 'daily',
            ],
            [
                'key' => 'session_timeout_minutes',
                'value' => '120',
            ],
            [
                'key' => 'password_reset_expiry_hours',
                'value' => '24',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSettings::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
