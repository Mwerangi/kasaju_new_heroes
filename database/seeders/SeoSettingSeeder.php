<?php

namespace Database\Seeders;

use App\Models\SeoSetting;
use Illuminate\Database\Seeder;

class SeoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seoSettings = [
            [
                'page' => 'home',
                'meta_title' => 'New Heroes International - Professional Clearing & Forwarding Services in Tanzania',
                'meta_description' => 'Leading clearing and forwarding company in Tanzania. We specialize in vehicle clearing, heavy machinery, customs documentation, and logistics coordination. Fast, reliable, and cost-effective services.',
                'meta_keywords' => 'clearing and forwarding Tanzania, cargo clearing Dar es Salaam, vehicle clearing Tanzania, customs clearance, freight forwarding, logistics Tanzania, import clearance',
                'og_title' => 'New Heroes International - Your Trusted Logistics Partner',
                'og_description' => 'Professional clearing and forwarding services in Tanzania. We handle vehicle clearing, heavy machinery, and all cargo types with expertise and efficiency.',
                'canonical_url' => url('/'),
            ],
            [
                'page' => 'about',
                'meta_title' => 'About Us - New Heroes International Limited',
                'meta_description' => 'Learn about New Heroes International, your trusted clearing and forwarding partner in Tanzania. Years of experience in logistics, customs clearance, and cargo forwarding.',
                'meta_keywords' => 'about New Heroes, clearing company Tanzania, forwarding company Dar es Salaam, logistics company, experienced clearing agents',
                'og_title' => 'About New Heroes International',
                'og_description' => 'Premier clearing and forwarding company in Dar es Salaam, Tanzania with years of experience in the logistics industry.',
                'canonical_url' => url('/about'),
            ],
            [
                'page' => 'services',
                'meta_title' => 'Our Services - Vehicle Clearing, Cargo Forwarding & More | New Heroes',
                'meta_description' => 'Comprehensive clearing and forwarding services: Vehicle clearing, heavy machinery, container cargo, customs documentation, warehousing, and port coordination in Tanzania.',
                'meta_keywords' => 'vehicle clearing services, cargo forwarding, heavy machinery clearing, customs documentation, warehousing Tanzania, port services Dar es Salaam',
                'og_title' => 'Professional Clearing & Forwarding Services',
                'og_description' => 'Complete range of clearing and forwarding services including vehicle clearing, heavy machinery, cargo forwarding, and customs documentation.',
                'canonical_url' => url('/services'),
            ],
            [
                'page' => 'gallery',
                'meta_title' => 'Gallery - Our Work in Action | New Heroes International',
                'meta_description' => 'View our photo gallery showcasing vehicle clearing operations, heavy machinery handling, port activities, and successful cargo clearance projects in Tanzania.',
                'meta_keywords' => 'clearing photos, cargo handling images, vehicle clearing gallery, port operations Tanzania, logistics photos',
                'og_title' => 'New Heroes International - Photo Gallery',
                'og_description' => 'See our professional cargo clearing services in action through our comprehensive photo gallery.',
                'canonical_url' => url('/gallery'),
            ],
            [
                'page' => 'blog',
                'meta_title' => 'Blog - Import Guides & Clearing Tips | New Heroes International',
                'meta_description' => 'Read expert guides on vehicle importing, cargo clearing procedures, customs regulations in Tanzania, and professional tips from experienced clearing agents.',
                'meta_keywords' => 'import guides Tanzania, vehicle import guide, cargo clearing tips, customs procedures, clearing blog, forwarding advice',
                'og_title' => 'Import Guides & Clearing Expert Tips',
                'og_description' => 'Expert guides and tips on importing vehicles, clearing cargo, and navigating customs procedures in Tanzania.',
                'canonical_url' => url('/blog'),
            ],
            [
                'page' => 'contact',
                'meta_title' => 'Contact Us - Get a Quote | New Heroes International',
                'meta_description' => 'Contact New Heroes International for professional clearing and forwarding services in Tanzania. Located in Dar es Salaam. Call +255625544404 or +255742058897 for quotes.',
                'meta_keywords' => 'contact clearing agent, clearing services quote, New Heroes contact, Dar es Salaam clearing agent, get clearing quote',
                'og_title' => 'Contact New Heroes International',
                'og_description' => 'Get in touch with us for professional clearing and forwarding services in Tanzania. Request a quote today!',
                'canonical_url' => url('/contact'),
            ],
        ];

        foreach ($seoSettings as $setting) {
            SeoSetting::updateOrCreate(
                ['page' => $setting['page']],
                $setting
            );
        }

        $this->command->info('✅ SEO settings seeded successfully for all pages!');
    }
}
