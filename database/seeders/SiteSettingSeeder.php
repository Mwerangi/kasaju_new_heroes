<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
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
                'value' => 'New Heroes International Limited',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Website name',
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Your Trusted Logistics Partner',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Website tagline',
            ],
            [
                'key' => 'site_email',
                'value' => 'info@newheroesintl.com',
                'type' => 'email',
                'group' => 'general',
                'description' => 'Primary email address',
            ],
            [
                'key' => 'site_phone',
                'value' => '+255 625 544 404',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Primary phone number',
            ],
            [
                'key' => 'address',
                'value' => 'Leader House Floor 1 Room 120, Dar es Salaam, Tanzania',
                'type' => 'textarea',
                'group' => 'general',
                'description' => 'Business address',
            ],
            [
                'key' => 'google_analytics_id',
                'value' => '',
                'type' => 'text',
                'group' => 'analytics',
                'description' => 'Google Analytics tracking ID',
            ],
            [
                'key' => 'maintenance_mode',
                'value' => '0',
                'type' => 'boolean',
                'group' => 'general',
                'description' => 'Enable maintenance mode',
            ],
            [
                'key' => 'allow_inquiries',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'general',
                'description' => 'Allow inquiry submissions',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
