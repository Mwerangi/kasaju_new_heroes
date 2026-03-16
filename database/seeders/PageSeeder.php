<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Home Page
        $homePage = Page::updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Home',
                'meta_title' => 'New Heroes International - Professional Clearing & Forwarding Services',
                'meta_description' => 'Leading clearing and forwarding company in Tanzania. We specialize in vehicle clearing, heavy machinery, customs documentation, and logistics coordination.',
                'meta_keywords' => 'clearing, forwarding, logistics, Tanzania, cargo, customs',
                'is_active' => true,
            ]
        );

        PageSection::updateOrCreate(
            [
                'page_id' => $homePage->id,
                'section_key' => 'hero',
            ],
            [
            'title' => 'Professional Clearing & Forwarding Services',
            'subtitle' => 'Your Trusted Logistics Partner in Tanzania',
            'content' => null,
            'button_text' => 'Request a Quote',
            'button_link' => '/request-quote',
            'order' => 1,
            'is_active' => true,
        ]);

        // About Page
        $aboutPage = Page::updateOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'About Us',
                'meta_title' => 'About New Heroes International Limited',
                'meta_description' => 'Learn more about New Heroes International, your trusted clearing and forwarding partner in Tanzania.',
                'is_active' => true,
            ]
        );

        // Hero Section
        PageSection::updateOrCreate(
            [
                'page_id' => $aboutPage->id,
                'section_key' => 'hero',
            ],
            [
                'title' => 'NEW HEROES INTERNATIONAL LIMITED',
                'subtitle' => 'Your Trusted Partner in Cargo Clearing and Logistics',
                'content' => 'A professional clearing and forwarding company based in Dar es Salaam, Tanzania, specializing in efficient handling and clearance of cargo through major ports.',
                'order' => 1,
                'is_active' => true,
            ]
        );

        // Company Overview
        PageSection::updateOrCreate(
            [
                'page_id' => $aboutPage->id,
                'section_key' => 'overview',
            ],
            [
                'title' => 'About Our Company',
                'subtitle' => null,
                'content' => '<p>NEW HEROES INTERNATIONAL LIMITED is a professional clearing and forwarding company based in Dar es Salaam, Tanzania, specializing in the efficient handling and clearance of cargo through major ports. The company focuses primarily on the clearance of motor vehicles, heavy machinery, and industrial equipment, providing reliable logistics support to individuals, businesses, and organizations.</p>
<p>With extensive knowledge of port procedures, customs regulations, and cargo logistics, we ensure that shipments are processed efficiently and delivered safely to their final destination. Our goal is to simplify the import process for our clients by handling all required documentation, coordination, and cargo clearance procedures with professionalism and transparency.</p>
<p>At NEW HEROES INTERNATIONAL LIMITED, we understand the importance of time, accuracy, and compliance in cargo clearing operations. Our experienced team works closely with customs authorities, port officials, and logistics partners to ensure smooth and efficient cargo processing.</p>',
                'order' => 2,
                'is_active' => true,
            ]
        );

        // Mission
        PageSection::updateOrCreate(
            [
                'page_id' => $aboutPage->id,
                'section_key' => 'mission',
            ],
            [
                'title' => 'Our Mission',
                'content' => '<p>Our mission is to provide efficient, reliable, and transparent clearing and forwarding services that simplify cargo movement through ports while ensuring full compliance with customs regulations and industry standards.</p>
<p>We aim to deliver services that help our clients move their cargo quickly and efficiently while minimizing delays and operational challenges.</p>',
                'order' => 3,
                'is_active' => true,
            ]
        );

        // Vision
        PageSection::updateOrCreate(
            [
                'page_id' => $aboutPage->id,
                'section_key' => 'vision',
            ],
            [
                'title' => 'Our Vision',
                'content' => '<p>Our vision is to become a trusted and leading clearing and forwarding company in Tanzania, recognized for professionalism, reliability, and excellence in cargo logistics and customs clearance services.</p>
<p>We strive to build long-term relationships with our clients by consistently delivering high-quality service and dependable logistics solutions.</p>',
                'order' => 4,
                'is_active' => true,
            ]
        );

        // Core Values
        PageSection::updateOrCreate(
            [
                'page_id' => $aboutPage->id,
                'section_key' => 'values',
            ],
            [
                'title' => 'Our Core Values',
                'subtitle' => 'The principles that guide everything we do',
                'content' => null,
                'order' => 5,
                'is_active' => true,
                'additional_data' => [
                    [
                        'icon' => 'fa-balance-scale',
                        'color' => 'green',
                        'title' => 'Integrity',
                        'description' => 'We conduct our business with honesty, transparency, and accountability in every service we provide.',
                    ],
                    [
                        'icon' => 'fa-user-tie',
                        'color' => 'blue',
                        'title' => 'Professionalism',
                        'description' => 'We maintain high standards of professionalism and expertise in handling cargo clearance and logistics operations.',
                    ],
                    [
                        'icon' => 'fa-bolt',
                        'color' => 'purple',
                        'title' => 'Efficiency',
                        'description' => 'We focus on delivering fast and reliable services by ensuring accurate documentation and streamlined cargo clearance procedures.',
                    ],
                    [
                        'icon' => 'fa-handshake',
                        'color' => 'orange',
                        'title' => 'Customer Commitment',
                        'description' => 'Our clients are at the center of our operations, and we strive to provide solutions that meet their logistics needs.',
                    ],
                    [
                        'icon' => 'fa-shield-alt',
                        'color' => 'red',
                        'title' => 'Reliability',
                        'description' => 'We aim to be a dependable logistics partner by delivering consistent and reliable services.',
                    ],
                    [
                        'icon' => 'fa-star',
                        'color' => 'yellow',
                        'title' => 'Excellence',
                        'description' => 'We continuously strive for excellence in every aspect of our service delivery and client relationships.',
                    ],
                ],
            ]
        );

        // What We Do
        PageSection::updateOrCreate(
            [
                'page_id' => $aboutPage->id,
                'section_key' => 'services',
            ],
            [
                'title' => 'What We Do',
                'subtitle' => 'NEW HEROES INTERNATIONAL LIMITED provides a range of clearing and logistics services designed to simplify cargo importation processes.',
                'content' => null,
                'order' => 6,
                'is_active' => true,
                'additional_data' => [
                    [
                        'icon' => 'fa-car',
                        'title' => 'Motor Vehicle Clearing',
                        'description' => 'Professional clearance services for all types of vehicles',
                    ],
                    [
                        'icon' => 'fa-truck-monster',
                        'title' => 'Heavy Machinery Clearing',
                        'description' => 'Specialized handling of industrial equipment and machinery',
                    ],
                    [
                        'icon' => 'fa-file-contract',
                        'title' => 'Customs Documentation',
                        'description' => 'Complete documentation and compliance support',
                    ],
                    [
                        'icon' => 'fa-ship',
                        'title' => 'Port Cargo Handling',
                        'description' => 'Efficient coordination and cargo management at ports',
                    ],
                    [
                        'icon' => 'fa-shipping-fast',
                        'title' => 'Logistics Coordination',
                        'description' => 'End-to-end cargo delivery coordination services',
                    ],
                    [
                        'icon' => 'fa-comments',
                        'title' => 'Import Consultation',
                        'description' => 'Expert guidance on import processes and regulations',
                    ],
                ],
            ]
        );

        // Why Choose Us
        PageSection::updateOrCreate(
            [
                'page_id' => $aboutPage->id,
                'section_key' => 'why_choose',
            ],
            [
                'title' => 'Why Choose NEW HEROES INTERNATIONAL',
                'subtitle' => null,
                'content' => null,
                'order' => 7,
                'is_active' => true,
                'additional_data' => [
                    [
                        'icon' => 'fa-users',
                        'color' => 'blue',
                        'title' => 'Experienced Team',
                        'description' => 'Our team has strong knowledge of customs procedures, port operations, and cargo clearance processes.',
                    ],
                    [
                        'icon' => 'fa-tachometer-alt',
                        'color' => 'green',
                        'title' => 'Efficient Cargo Processing',
                        'description' => 'We ensure proper documentation and efficient coordination with port authorities to minimize delays.',
                    ],
                    [
                        'icon' => 'fa-medal',
                        'color' => 'purple',
                        'title' => 'Professional Service',
                        'description' => 'We maintain high standards of professionalism and transparency in every transaction.',
                    ],
                    [
                        'icon' => 'fa-truck',
                        'color' => 'orange',
                        'title' => 'Reliable Logistics Support',
                        'description' => 'Our clients rely on us to manage cargo clearance and logistics coordination efficiently.',
                    ],
                ],
            ]
        );

        // Industries
        PageSection::updateOrCreate(
            [
                'page_id' => $aboutPage->id,
                'section_key' => 'industries',
            ],
            [
                'title' => 'Industries We Serve',
                'subtitle' => 'Our services support a wide range of industries',
                'content' => null,
                'order' => 8,
                'is_active' => true,
                'additional_data' => [
                    ['icon' => 'fa-car-side', 'color' => 'blue', 'title' => 'Vehicle Importers'],
                    ['icon' => 'fa-hard-hat', 'color' => 'orange', 'title' => 'Construction'],
                    ['icon' => 'fa-cogs', 'color' => 'purple', 'title' => 'Machinery Suppliers'],
                    ['icon' => 'fa-truck-loading', 'color' => 'green', 'title' => 'Transport & Logistics'],
                    ['icon' => 'fa-tools', 'color' => 'red', 'title' => 'Contractors'],
                    ['icon' => 'fa-user', 'color' => 'yellow', 'title' => 'Individual Importers'],
                ],
            ]
        );

        // Commitment
        PageSection::updateOrCreate(
            [
                'page_id' => $aboutPage->id,
                'section_key' => 'commitment',
            ],
            [
                'title' => 'Our Commitment',
                'subtitle' => null,
                'content' => '<p>At NEW HEROES INTERNATIONAL LIMITED, we are committed to delivering reliable clearing and forwarding services while maintaining high standards of professionalism and transparency.</p>
<p>Our goal is to build long-term partnerships with our clients by providing dependable cargo clearance solutions that support their business operations.</p>',
                'order' => 9,
                'is_active' => true,
            ]
        );
    }
}
