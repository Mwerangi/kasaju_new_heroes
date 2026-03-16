<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            UserSeeder::class,
            PageSeeder::class,
            ServiceSeeder::class,
            ProcessStepSeeder::class,
            ContactInformationSeeder::class,
            SiteSettingSeeder::class,
            SeoSettingSeeder::class,
            GalleryCategorySeeder::class,
            TestimonialSeeder::class,
            BlogPostsSeeder::class,
        ]);
    }
}
