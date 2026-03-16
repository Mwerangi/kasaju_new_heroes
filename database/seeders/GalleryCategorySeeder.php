<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use Illuminate\Database\Seeder;

class GalleryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Vehicle Clearing',
                'slug' => 'vehicle-clearing',
                'description' => 'Photos of our vehicle clearing and customs documentation services',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Heavy Machinery',
                'slug' => 'heavy-machinery',
                'description' => 'Clearing and forwarding of construction equipment and heavy machinery',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Container Cargo',
                'slug' => 'container-cargo',
                'description' => 'Container loading, unloading, and customs clearance operations',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Documentation',
                'slug' => 'documentation',
                'description' => 'Customs documentation and processing at TRA offices',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Warehouse Operations',
                'slug' => 'warehouse-operations',
                'description' => 'Cargo storage and warehouse management facilities',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Port Activities',
                'slug' => 'port-activities',
                'description' => 'Operations at Dar es Salaam Port and other entry points',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            GalleryCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        $this->command->info('✅ Gallery categories seeded successfully!');
    }
}
