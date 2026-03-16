<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Str;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Motor Vehicle Clearing Services',
                'slug' => 'motor-vehicle-clearing',
                'short_description' => 'Professional motor vehicle clearing services at Dar es Salaam Port. We handle passenger vehicles, trucks, buses and commercial vehicles with efficient customs processing.',
                'description' => '<div class="service-content">
                    <h2>Motor Vehicle Clearing Services</h2>
                    <p>NEW HEROES INTERNATIONAL LIMITED provides professional motor vehicle clearing services in Tanzania, ensuring that imported vehicles are processed quickly and in full compliance with customs regulations. With extensive experience in port operations and customs documentation, our team ensures smooth clearance of vehicles from the port to the final destination.</p>
                    
                    <p>We assist individuals, vehicle dealers, and businesses importing vehicles through Dar es Salaam Port by managing the entire clearing process efficiently.</p>
                    
                    <p>Our team handles the documentation, customs procedures, cargo verification, and release coordination to ensure that vehicles are cleared without unnecessary delays.</p>
                    
                    <h3>Types of Vehicles We Clear</h3>
                    <p>We specialize in clearing different types of vehicles including:</p>
                    <ul>
                        <li>Passenger vehicles</li>
                        <li>Commercial vehicles</li>
                        <li>Trucks and trailers</li>
                        <li>Buses</li>
                        <li>Specialized vehicles</li>
                        <li>Fleet vehicles</li>
                        <li>Utility vehicles</li>
                    </ul>
                    
                    <p>Whether you are importing a single vehicle or multiple vehicles for business purposes, our experienced team ensures professional handling of every shipment.</p>
                    
                    <h3>Our Vehicle Clearing Process</h3>
                    <p>Our vehicle clearing services follow a structured process to ensure efficient results.</p>
                    <ul>
                        <li>Verification of shipping documents</li>
                        <li>Customs declaration and duty assessment coordination</li>
                        <li>Inspection coordination with relevant authorities</li>
                        <li>Processing of customs documentation</li>
                        <li>Cargo release from port</li>
                        <li>Vehicle dispatch and delivery coordination</li>
                    </ul>
                    
                    <p>This structured process ensures that vehicles are cleared efficiently and delivered safely.</p>
                    
                    <h3>Why Choose Our Vehicle Clearing Services</h3>
                    <ul>
                        <li>Experienced clearing professionals</li>
                        <li>Fast and efficient processing</li>
                        <li>Compliance with customs regulations</li>
                        <li>Transparent communication with clients</li>
                        <li>Reliable cargo handling</li>
                    </ul>
                    
                    <h3>Request Vehicle Clearing Assistance</h3>
                    <p>If you are importing a vehicle into Tanzania and require professional clearing services, contact NEW HEROES INTERNATIONAL LIMITED for reliable assistance.</p>
                </div>',
                'icon' => 'fas fa-car',
                'order' => 1,
                'is_featured' => true,
                'is_active' => true,
                'meta_title' => 'Motor Vehicle Clearing Services in Tanzania | NEW HEROES INTERNATIONAL LIMITED',
                'meta_description' => 'Professional motor vehicle clearing services at Dar es Salaam Port. We handle passenger vehicles, trucks, buses and commercial vehicles with efficient customs processing.',
            ],
            [
                'title' => 'Heavy Machinery Clearing Services',
                'slug' => 'heavy-machinery-clearing',
                'short_description' => 'Professional clearing services for heavy machinery including excavators, bulldozers, cranes and construction equipment through Dar es Salaam Port.',
                'description' => '<div class="service-content">
                    <h2>Heavy Machinery Clearing Services</h2>
                    <p>NEW HEROES INTERNATIONAL LIMITED provides professional heavy machinery clearing services for businesses importing industrial and construction equipment into Tanzania.</p>
                    
                    <p>Heavy equipment imports require specialized documentation, proper cargo classification, and coordination with customs authorities. Our experienced team ensures that all requirements are met and that machinery is cleared efficiently.</p>
                    
                    <p>We assist construction companies, contractors, equipment suppliers, and agricultural businesses with the clearance of heavy machinery.</p>
                    
                    <h3>Types of Machinery We Clear</h3>
                    <p>Our services cover a wide range of equipment including:</p>
                    <ul>
                        <li>Excavators</li>
                        <li>Bulldozers</li>
                        <li>Cranes</li>
                        <li>Loaders</li>
                        <li>Road construction machinery</li>
                        <li>Agricultural equipment</li>
                        <li>Industrial equipment</li>
                        <li>Mining equipment</li>
                    </ul>
                    
                    <p>We ensure that all machinery imports are processed professionally and released without unnecessary delays.</p>
                    
                    <h3>Machinery Clearance Process</h3>
                    <p>The heavy machinery clearing process includes:</p>
                    <ul>
                        <li>Review of import documentation</li>
                        <li>Customs declaration processing</li>
                        <li>Coordination of inspection procedures</li>
                        <li>Duty and tax assessment support</li>
                        <li>Clearance approval and cargo release</li>
                        <li>Transportation coordination</li>
                    </ul>
                    
                    <p>Our team ensures that every step is handled efficiently to minimize delays.</p>
                    
                    <h3>Advantages of Our Machinery Clearing Services</h3>
                    <ul>
                        <li>Expertise in equipment import procedures</li>
                        <li>Professional documentation handling</li>
                        <li>Efficient port coordination</li>
                        <li>Reduced cargo delays</li>
                        <li>Reliable logistics support</li>
                    </ul>
                </div>',
                'icon' => 'fas fa-truck-monster',
                'order' => 2,
                'is_featured' => true,
                'is_active' => true,
                'meta_title' => 'Heavy Machinery Clearing Services | Equipment Import Clearance Tanzania',
                'meta_description' => 'Professional clearing services for heavy machinery including excavators, bulldozers, cranes and construction equipment through Dar es Salaam Port.',
            ],
            [
                'title' => 'Customs Documentation and Compliance',
                'slug' => 'customs-documentation',
                'short_description' => 'Professional customs documentation and compliance services for cargo imports through Dar es Salaam Port.',
                'description' => '<div class="service-content">
                    <h2>Customs Documentation Services</h2>
                    <p>Proper documentation is essential for successful cargo clearance. NEW HEROES INTERNATIONAL LIMITED provides expert assistance in preparing and processing all customs documentation required for import clearance.</p>
                    
                    <p>Our experienced team ensures that all documentation is accurate, compliant with regulations, and submitted on time to avoid delays.</p>
                    
                    <p>We assist businesses and individuals importing vehicles, machinery, and other cargo through Tanzania\'s ports.</p>
                    
                    <h3>Documentation Services We Provide</h3>
                    <p>Our customs documentation services include:</p>
                    <ul>
                        <li>Import documentation preparation</li>
                        <li>Customs declaration processing</li>
                        <li>Duty and tax assessment coordination</li>
                        <li>Cargo inspection documentation</li>
                        <li>Compliance with import regulations</li>
                    </ul>
                    
                    <p>By ensuring that documentation is properly prepared, we help clients avoid unnecessary complications during the clearance process.</p>
                    
                    <h3>Benefits of Our Documentation Services</h3>
                    <ul>
                        <li>Accurate documentation preparation</li>
                        <li>Reduced risk of clearance delays</li>
                        <li>Compliance with regulatory requirements</li>
                        <li>Efficient cargo processing</li>
                    </ul>
                </div>',
                'icon' => 'fas fa-file-contract',
                'order' => 3,
                'is_featured' => true,
                'is_active' => true,
                'meta_title' => 'Customs Documentation Services Tanzania | Cargo Clearance Experts',
                'meta_description' => 'Professional customs documentation and compliance services for cargo imports through Dar es Salaam Port.',
            ],
            [
                'title' => 'Port Cargo Handling Services',
                'slug' => 'port-cargo-handling',
                'short_description' => 'Professional cargo handling and coordination services at Dar es Salaam Port for vehicles, machinery and general cargo.',
                'description' => '<div class="service-content">
                    <h2>Port Cargo Handling and Coordination</h2>
                    <p>NEW HEROES INTERNATIONAL LIMITED provides professional port cargo handling services to assist clients with cargo processing and coordination within the port environment.</p>
                    
                    <p>Handling cargo at the port involves multiple procedures including documentation verification, cargo inspection, coordination with port authorities, and cargo release processing.</p>
                    
                    <p>Our team ensures that cargo procedures are handled efficiently and that all required processes are completed smoothly.</p>
                    
                    <h3>Cargo Handling Services Include</h3>
                    <ul>
                        <li>Cargo verification procedures</li>
                        <li>Coordination with port authorities</li>
                        <li>Cargo inspection management</li>
                        <li>Documentation handling</li>
                        <li>Cargo release procedures</li>
                    </ul>
                    
                    <p>Our experience in port operations allows us to manage cargo procedures efficiently and ensure timely cargo release.</p>
                </div>',
                'icon' => 'fas fa-ship',
                'order' => 4,
                'is_featured' => false,
                'is_active' => true,
                'meta_title' => 'Port Cargo Handling Services Dar es Salaam | Cargo Clearance Support',
                'meta_description' => 'Professional cargo handling and coordination services at Dar es Salaam Port for vehicles, machinery and general cargo.',
            ],
            [
                'title' => 'Logistics and Cargo Delivery Coordination',
                'slug' => 'logistics-coordination',
                'short_description' => 'Reliable logistics and cargo delivery coordination services from port to destination for vehicles and heavy machinery.',
                'description' => '<div class="service-content">
                    <h2>Logistics and Cargo Delivery Coordination</h2>
                    <p>After cargo clearance is completed, the next important step is transportation to the final destination. NEW HEROES INTERNATIONAL LIMITED provides professional logistics coordination services to ensure smooth cargo delivery.</p>
                    
                    <p>We assist clients in organizing transportation for vehicles, machinery, and other cargo from the port to warehouses, business locations, or project sites.</p>
                    
                    <p>Our logistics coordination ensures that cargo is transported safely and efficiently.</p>
                    
                    <h3>Logistics Services Include</h3>
                    <ul>
                        <li>Cargo transportation coordination</li>
                        <li>Vehicle dispatch from port</li>
                        <li>Machinery transport arrangements</li>
                        <li>Delivery planning and scheduling</li>
                    </ul>
                    
                    <p>Our team ensures that cargo reaches its destination safely and on time.</p>
                </div>',
                'icon' => 'fas fa-shipping-fast',
                'order' => 5,
                'is_featured' => false,
                'is_active' => true,
                'meta_title' => 'Cargo Delivery and Logistics Coordination | Port Cargo Transport',
                'meta_description' => 'Reliable logistics and cargo delivery coordination services from port to destination for vehicles and heavy machinery.',
            ],
            [
                'title' => 'Import Process Consultation',
                'slug' => 'import-consultation',
                'short_description' => 'Professional consultation services for importing vehicles, machinery and cargo into Tanzania.',
                'description' => '<div class="service-content">
                    <h2>Import Process Consultation</h2>
                    <p>NEW HEROES INTERNATIONAL LIMITED provides professional consultation services to individuals and businesses that require guidance on importing cargo into Tanzania.</p>
                    
                    <p>Importing vehicles and machinery involves several regulatory procedures and documentation requirements. Our team assists clients by explaining the process and ensuring that they are properly prepared before cargo arrives.</p>
                    
                    <h3>Consultation Services Include</h3>
                    <ul>
                        <li>Guidance on import procedures</li>
                        <li>Documentation requirements</li>
                        <li>Customs clearance process explanation</li>
                        <li>Cargo handling requirements</li>
                        <li>Import regulation awareness</li>
                    </ul>
                    
                    <p>This service helps clients avoid delays and ensures a smoother cargo clearance process.</p>
                </div>',
                'icon' => 'fas fa-comments',
                'order' => 6,
                'is_featured' => false,
                'is_active' => true,
                'meta_title' => 'Import Consultation Services Tanzania | Cargo Import Guidance',
                'meta_description' => 'Professional consultation services for importing vehicles, machinery and cargo into Tanzania.',
            ],
        ];

        foreach ($services as $serviceData) {
            // Check if service exists (including soft-deleted)
            $service = Service::withTrashed()->where('slug', $serviceData['slug'])->first();
            
            if ($service) {
                // Restore if soft-deleted
                if ($service->trashed()) {
                    $service->restore();
                }
                // Update the service
                $service->update($serviceData);
            } else {
                // Create new service
                Service::create($serviceData);
            }
        }

        // Delete the Cargo Insurance service as it's not in the new list
        Service::where('slug', 'cargo-insurance')->delete();

        $this->command->info('Services seeded successfully!');
    }
}
