<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'John Mwakasege',
                'company_name' => 'Mwakasege Construction Ltd',
                'position' => 'Operations Manager',
                'testimonial' => 'New Heroes International has been exceptional in handling our heavy machinery imports. Their team is professional, efficient, and always keeps us informed throughout the clearance process. We have cleared over 15 excavators and bulldozers through them, and the experience has been consistently excellent.',
                'rating' => 5,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'client_name' => 'Sarah Kimaro',
                'company_name' => 'Kimaro Motors Tanzania',
                'position' => 'CEO',
                'testimonial' => 'I have been importing vehicles from Japan for the past 3 years, and New Heroes has made the entire process seamless. Their knowledge of customs procedures and competitive pricing has saved us both time and money. Highly recommended for anyone importing vehicles into Tanzania.',
                'rating' => 5,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'client_name' => 'David Msangi',
                'company_name' => 'Msangi Logistics',
                'position' => 'Director',
                'testimonial' => 'Professional service from start to finish. The team at New Heroes handled all our documentation efficiently and ensured our cargo cleared customs without any delays. Their attention to detail and customer service is outstanding.',
                'rating' => 5,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'client_name' => 'Grace Mtuy',
                'company_name' => 'Mtuy Investments',
                'position' => 'Managing Partner',
                'testimonial' => 'Clearing and forwarding services at their best! New Heroes International cleared our container shipment within record time. Their team is knowledgeable, transparent with pricing, and always available to answer questions. Will definitely use their services again.',
                'rating' => 5,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'client_name' => 'Michael Nkya',
                'company_name' => 'Nkya Trading Company',
                'position' => 'Owner',
                'testimonial' => 'I was worried about the complexity of importing my business vehicle from Dubai, but New Heroes made it so simple. They handled everything from port documentation to TRA processing. The entire vehicle was cleared and delivered to my premises within 5 days. Excellent work!',
                'rating' => 5,
                'order' => 5,
                'is_active' => true,
            ],
            [
                'client_name' => 'Elizabeth Mbwambo',
                'company_name' => 'Mbwambo Enterprises',
                'position' => 'Procurement Manager',
                'testimonial' => 'Working with New Heroes has been a game-changer for our import operations. Their efficiency in handling cargo clearing and their proactive communication keeps our supply chain running smoothly. We trust them with all our clearing needs.',
                'rating' => 5,
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                [
                    'client_name' => $testimonial['client_name'],
                    'company_name' => $testimonial['company_name'],
                ],
                $testimonial
            );
        }

        $this->command->info('✅ Testimonials seeded successfully!');
        $this->command->info('📝 Created 6 customer testimonials');
    }
}
