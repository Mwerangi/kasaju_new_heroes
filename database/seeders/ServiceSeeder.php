<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Motor Vehicle Clearing',
                'slug' => 'motor-vehicle-clearing',
                'short_description' => 'Professional vehicle clearing services for personal and commercial vehicles',
                'description' => '<p>We provide comprehensive motor vehicle clearing services for all types of vehicles. Our experienced team handles all documentation, customs procedures, and ensures your vehicle is cleared efficiently and cost-effectively.</p><p>Services include: customs declaration, duty calculation, TRA processing, vehicle inspection coordination, and delivery arrangements.</p>',
                'order' => 1,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Heavy Machinery Clearing',
                'slug' => 'heavy-machinery-clearing',
                'short_description' => 'Specialized clearing for construction and industrial equipment',
                'description' => '<p>Specialized in clearing heavy machinery and industrial equipment. We understand the complexities involved in importing large equipment and provide tailored solutions for construction machinery, manufacturing equipment, and agricultural machinery.</p>',
                'order' => 2,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Customs Documentation',
                'slug' => 'customs-documentation',
                'short_description' => 'Complete customs documentation and compliance services',
                'description' => '<p>Expert handling of all customs documentation requirements. We ensure compliance with Tanzania Revenue Authority (TRA) regulations and international trade requirements. Our team manages all paperwork, reducing delays and ensuring smooth clearance.</p>',
                'order' => 3,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Port Cargo Handling',
                'slug' => 'port-cargo-handling',
                'short_description' => 'Efficient port operations and cargo handling services',
                'description' => '<p>Comprehensive port cargo handling services at Dar es Salaam port. We coordinate with port authorities, handle cargo verification, arrange container stuffing/destuffing, and ensure safe handling of your goods.</p>',
                'order' => 4,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Logistics Coordination',
                'slug' => 'logistics-coordination',
                'short_description' => 'End-to-end logistics management and coordination',
                'description' => '<p>Full logistics coordination services from port to final destination. We manage transportation, warehousing when needed, and ensure timely delivery. Our network covers all major cities in Tanzania.</p>',
                'order' => 5,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Cargo Insurance',
                'slug' => 'cargo-insurance',
                'short_description' => 'Comprehensive cargo insurance solutions',
                'description' => '<p>We offer cargo insurance services to protect your valuable goods during transit and clearing process. Get peace of mind knowing your cargo is protected against unforeseen circumstances.</p>',
                'order' => 6,
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['slug' => $service['slug']],
                $service
            );
        }
    }
}
