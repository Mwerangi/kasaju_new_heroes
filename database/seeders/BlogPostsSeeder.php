<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\User;
use Carbon\Carbon;

class BlogPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create blog categories
        $importGuideCategory = BlogCategory::firstOrCreate(
            ['slug' => 'import-guides'],
            [
                'name' => 'Import Guides',
                'description' => 'Step-by-step guides and tutorials for importing vehicles and cargo into Tanzania',
                'order' => 1,
                'is_active' => true,
            ]
        );

        $tipsCategory = BlogCategory::firstOrCreate(
            ['slug' => 'tips-advice'],
            [
                'name' => 'Tips & Advice',
                'description' => 'Expert tips and advice for smooth cargo clearance',
                'order' => 2,
                'is_active' => true,
            ]
        );

        // Get the first admin user as author
        $author = User::first();

        $blogPosts = [
            [
                'category_id' => $importGuideCategory->id,
                'title' => 'How to Import a Vehicle into Tanzania Through Dar es Salaam Port',
                'slug' => 'how-to-import-vehicle-tanzania-dar-es-salaam-port',
                'excerpt' => 'A complete step-by-step guide on how to import vehicles into Tanzania through Dar es Salaam Port including documents, customs procedures, and clearance timelines.',
                'content' => '<h2>Introduction</h2>
<p>Importing a vehicle into Tanzania involves several regulatory and logistical procedures that must be completed before the vehicle can be released from the port. Whether you are importing a personal car, a commercial vehicle, or a fleet of vehicles for business, understanding the clearance process helps prevent delays and unexpected costs.</p>

<p>Dar es Salaam Port is the main gateway for vehicle imports into Tanzania and neighboring countries. Once a vehicle arrives at the port, it must go through customs processing, documentation verification, duty assessment, and inspection procedures before it can be released.</p>

<p>Working with a professional clearing agent can simplify the process and ensure that all procedures are handled efficiently.</p>

<h3>Step 1: Prepare Required Documentation</h3>
<p>Before importing a vehicle, it is important to prepare all necessary documents. These documents help customs authorities verify the cargo and determine applicable duties.</p>

<p><strong>Common documents required include:</strong></p>
<ul>
    <li>Bill of Lading</li>
    <li>Commercial Invoice</li>
    <li>Import Declaration Form</li>
    <li>Packing List (if applicable)</li>
    <li>Identification documents of importer</li>
</ul>

<p>Ensuring that these documents are accurate and complete will help prevent delays during customs processing.</p>

<h3>Step 2: Customs Declaration</h3>
<p>Once the vehicle arrives at the port, a customs declaration must be submitted to customs authorities. The declaration provides details about the vehicle, its value, and other important information required for duty assessment.</p>

<p>Customs authorities will review the documentation and determine the applicable taxes and duties.</p>

<h3>Step 3: Duty Assessment and Payment</h3>
<p>Import duties and taxes are calculated based on the assessed value of the vehicle. The assessed value may include:</p>
<ul>
    <li>Vehicle purchase price</li>
    <li>Freight charges</li>
    <li>Insurance costs</li>
</ul>

<p>After the duties and taxes are paid, the clearance process continues to the next stage.</p>

<h3>Step 4: Cargo Inspection</h3>
<p>Customs authorities may conduct inspections to verify the condition and details of the vehicle. This process ensures that the vehicle matches the documentation submitted during the declaration process.</p>

<p>Once the inspection is completed successfully, the vehicle becomes eligible for release.</p>

<h3>Step 5: Cargo Release and Delivery</h3>
<p>After all procedures are completed, customs authorities issue clearance approval and the vehicle can be released from the port. The vehicle can then be transported to the importer\'s designated location.</p>

<p>Professional clearing agents coordinate these procedures to ensure smooth cargo processing.</p>',
                'meta_title' => 'How to Import a Vehicle into Tanzania | Complete Guide for Dar es Salaam Port',
                'meta_description' => 'A complete step-by-step guide on how to import vehicles into Tanzania through Dar es Salaam Port including documents, customs procedures, and clearance timelines.',
                'meta_keywords' => 'import vehicle Tanzania, Dar es Salaam Port, vehicle clearance, customs procedures, import documentation',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(30),
                'views' => rand(150, 500),
            ],
            [
                'category_id' => $importGuideCategory->id,
                'title' => 'Documents Required for Vehicle Clearance in Tanzania',
                'slug' => 'documents-required-vehicle-clearance-tanzania',
                'excerpt' => 'Learn the essential documents required for clearing imported vehicles at Tanzanian ports to ensure a smooth cargo clearance process.',
                'content' => '<h2>Introduction</h2>
<p>Proper documentation is one of the most important aspects of the cargo clearing process. When importing vehicles into Tanzania, customs authorities require several documents to verify shipment details, calculate duties, and authorize cargo release.</p>

<p>Failure to provide the correct documentation can result in delays, additional costs, or complications during the clearance process.</p>

<h3>Key Documents Required</h3>

<h4>Bill of Lading</h4>
<p>The Bill of Lading is issued by the shipping company and confirms that the cargo has been transported. It includes important information such as shipment details, cargo description, and consignee information.</p>

<h4>Commercial Invoice</h4>
<p>The commercial invoice provides details about the value of the vehicle being imported. Customs authorities use this document to calculate import duties and taxes.</p>

<h4>Import Declaration Form</h4>
<p>The Import Declaration Form is submitted to customs authorities to declare the cargo entering the country. It contains information about the importer, cargo description, and shipment value.</p>

<h4>Identification Documents</h4>
<p>Importers may also be required to provide identification documents such as national identification or company registration documents when clearing cargo.</p>

<h3>Importance of Accurate Documentation</h3>
<p>Accurate documentation ensures that cargo clearance procedures are completed efficiently. Professional clearing agents help verify documentation before submission to avoid errors that could cause delays.</p>',
                'meta_title' => 'Documents Required for Vehicle Clearance in Tanzania',
                'meta_description' => 'Learn the essential documents required for clearing imported vehicles at Tanzanian ports to ensure a smooth cargo clearance process.',
                'meta_keywords' => 'vehicle clearance documents, Tanzania customs, import documentation, Bill of Lading, commercial invoice',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(25),
                'views' => rand(100, 400),
            ],
            [
                'category_id' => $importGuideCategory->id,
                'title' => 'Step-by-Step Guide to Clearing Heavy Machinery',
                'slug' => 'step-by-step-guide-clearing-heavy-machinery',
                'excerpt' => 'A comprehensive guide on clearing heavy machinery and construction equipment through Tanzanian ports.',
                'content' => '<h2>Introduction</h2>
<p>Heavy machinery imports require careful handling because they involve complex documentation and regulatory requirements. Equipment such as excavators, bulldozers, and cranes must go through customs clearance procedures before being released from the port.</p>

<h3>Machinery Clearance Process</h3>

<h4>Document Verification</h4>
<p>The first step is verifying shipping documents to ensure that all required paperwork is available.</p>

<h4>Customs Declaration</h4>
<p>Customs declarations must be submitted to authorities, indicating the type of machinery being imported and its assessed value.</p>

<h4>Inspection Procedures</h4>
<p>Customs authorities may inspect machinery to verify its classification and condition.</p>

<h4>Duty Processing</h4>
<p>Applicable duties and taxes are calculated based on machinery value and classification.</p>

<h4>Cargo Release</h4>
<p>Once all procedures are completed, the machinery is released and transported to the client.</p>',
                'meta_title' => 'Step-by-Step Guide to Clearing Heavy Machinery in Tanzania',
                'meta_description' => 'A comprehensive guide on clearing heavy machinery and construction equipment through Tanzanian ports.',
                'meta_keywords' => 'heavy machinery clearance, construction equipment import, customs procedures, Tanzania port',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(20),
                'views' => rand(80, 300),
            ],
            [
                'category_id' => $tipsCategory->id,
                'title' => 'Common Mistakes That Delay Cargo Clearance',
                'slug' => 'common-mistakes-delay-cargo-clearance',
                'excerpt' => 'Avoid costly delays by learning about the most common mistakes made during cargo clearance and how to prevent them.',
                'content' => '<h2>Introduction</h2>
<p>Cargo clearance delays are often caused by avoidable mistakes during the import process.</p>

<h3>Common Issues Include:</h3>

<h4>Incorrect Documentation</h4>
<p>Missing or incorrect documents can delay customs verification.</p>

<h4>Incorrect Cargo Classification</h4>
<p>Misclassification of cargo can lead to disputes over duty assessment.</p>

<h4>Late Documentation Submission</h4>
<p>Submitting documents after cargo arrival can slow down clearance procedures.</p>

<h4>Lack of Professional Assistance</h4>
<p>Importers unfamiliar with clearance procedures may experience delays.</p>

<p>Professional clearing agents help prevent these issues by ensuring proper documentation and coordination with customs authorities.</p>',
                'meta_title' => 'Common Mistakes That Delay Cargo Clearance in Tanzania',
                'meta_description' => 'Avoid costly delays by learning about the most common mistakes made during cargo clearance and how to prevent them.',
                'meta_keywords' => 'cargo clearance delays, import mistakes, customs errors, clearing agent Tanzania',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(15),
                'views' => rand(120, 450),
            ],
            [
                'category_id' => $importGuideCategory->id,
                'title' => 'Understanding Customs Duty for Imported Vehicles',
                'slug' => 'understanding-customs-duty-imported-vehicles',
                'excerpt' => 'Learn how customs duty is calculated for imported vehicles in Tanzania and factors that affect duty rates.',
                'content' => '<h2>Introduction</h2>
<p>Import duties are calculated based on several factors including the vehicle\'s value, engine capacity, and regulatory classification.</p>

<p>Customs authorities assess the value of the vehicle using documentation provided by the importer.</p>

<h3>Factors Affecting Customs Duty</h3>
<ul>
    <li>Vehicle purchase price</li>
    <li>Engine capacity</li>
    <li>Vehicle age</li>
    <li>Type of vehicle</li>
    <li>Freight and insurance costs</li>
</ul>

<p>Importers should understand that additional fees may apply depending on regulatory requirements.</p>

<p>Consulting professional clearing agents can help estimate costs before importing vehicles.</p>',
                'meta_title' => 'Understanding Customs Duty for Imported Vehicles in Tanzania',
                'meta_description' => 'Learn how customs duty is calculated for imported vehicles in Tanzania and factors that affect duty rates.',
                'meta_keywords' => 'customs duty Tanzania, vehicle import tax, duty calculation, import costs',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(12),
                'views' => rand(200, 600),
            ],
            [
                'category_id' => $tipsCategory->id,
                'title' => 'Why Professional Clearing Agents Are Important',
                'slug' => 'why-professional-clearing-agents-important',
                'excerpt' => 'Discover the benefits of working with professional clearing agents for cargo imports in Tanzania.',
                'content' => '<h2>Introduction</h2>
<p>Clearing agents play a vital role in facilitating cargo movement through ports and customs procedures.</p>

<h3>Their Responsibilities Include:</h3>
<ul>
    <li>Preparing documentation</li>
    <li>Coordinating inspections</li>
    <li>Processing customs declarations</li>
    <li>Ensuring regulatory compliance</li>
    <li>Managing duty payments</li>
    <li>Coordinating cargo release</li>
</ul>

<h3>Benefits of Professional Assistance</h3>
<p>Working with experienced clearing agents helps importers:</p>
<ul>
    <li>Avoid documentation errors</li>
    <li>Speed up clearance procedures</li>
    <li>Ensure compliance with regulations</li>
    <li>Reduce delays and costs</li>
    <li>Access expert guidance</li>
</ul>

<p>Professional clearing agents ensure smooth cargo clearance and timely delivery.</p>',
                'meta_title' => 'Why Professional Clearing Agents Are Important for Tanzania Imports',
                'meta_description' => 'Discover the benefits of working with professional clearing agents for cargo imports in Tanzania.',
                'meta_keywords' => 'clearing agents Tanzania, professional clearing services, cargo import assistance, customs broker',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(10),
                'views' => rand(90, 350),
            ],
            [
                'category_id' => $tipsCategory->id,
                'title' => 'How Long Does Cargo Clearance Take in Tanzania?',
                'slug' => 'how-long-cargo-clearance-take-tanzania',
                'excerpt' => 'Understanding typical cargo clearance timelines and factors that influence processing time at Tanzanian ports.',
                'content' => '<h2>Introduction</h2>
<p>Cargo clearance timelines depend on factors such as documentation readiness and inspection requirements.</p>

<h3>Typical Timeline</h3>
<p>When documentation is properly prepared, clearance can be completed within a few days to a week.</p>

<h3>Factors That Affect Clearance Time</h3>
<ul>
    <li>Documentation completeness</li>
    <li>Customs inspection requirements</li>
    <li>Cargo type and classification</li>
    <li>Port congestion</li>
    <li>Duty payment processing</li>
</ul>

<h3>How to Speed Up Clearance</h3>
<p>To ensure faster clearance:</p>
<ul>
    <li>Prepare all documents in advance</li>
    <li>Work with professional clearing agents</li>
    <li>Ensure accurate cargo information</li>
    <li>Respond quickly to customs queries</li>
    <li>Have funds ready for duty payments</li>
</ul>

<p>Delays may occur when documents are incomplete or when additional inspections are required.</p>

<p>Professional clearing agents help speed up the process through proper coordination and documentation.</p>',
                'meta_title' => 'How Long Does Cargo Clearance Take in Tanzania? | Timeline Guide',
                'meta_description' => 'Understanding typical cargo clearance timelines and factors that influence processing time at Tanzanian ports.',
                'meta_keywords' => 'cargo clearance time, Tanzania port processing, clearance timeline, customs duration',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(7),
                'views' => rand(150, 500),
            ],
            [
                'category_id' => $tipsCategory->id,
                'title' => 'Tips for Importing Construction Equipment',
                'slug' => 'tips-importing-construction-equipment',
                'excerpt' => 'Essential tips and best practices for successfully importing construction equipment into Tanzania.',
                'content' => '<h2>Introduction</h2>
<p>Importing construction equipment requires careful planning and attention to detail.</p>

<h3>Important Tips Include:</h3>

<h4>Prepare Documents Before Shipment</h4>
<p>Have all required documentation ready before your equipment arrives at the port to avoid delays.</p>

<h4>Ensure Proper Cargo Classification</h4>
<p>Correctly classify your equipment to ensure accurate duty assessment and smooth customs processing.</p>

<h4>Work With Experienced Clearing Agents</h4>
<p>Professional clearing agents familiar with heavy equipment imports can guide you through the process.</p>

<h4>Plan Transportation After Clearance</h4>
<p>Arrange for appropriate transportation to move equipment from the port to your site.</p>

<h4>Budget for All Costs</h4>
<p>Consider duties, taxes, port fees, and transportation costs when budgeting for your import.</p>

<p>Proper preparation helps avoid delays and ensures efficient cargo clearance of construction equipment.</p>',
                'meta_title' => 'Tips for Importing Construction Equipment into Tanzania',
                'meta_description' => 'Essential tips and best practices for successfully importing construction equipment into Tanzania.',
                'meta_keywords' => 'construction equipment import, heavy machinery Tanzania, import tips, equipment clearance',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5),
                'views' => rand(70, 280),
            ],
            [
                'category_id' => $importGuideCategory->id,
                'title' => 'What to Know Before Importing Vehicles into Tanzania',
                'slug' => 'what-to-know-before-importing-vehicles-tanzania',
                'excerpt' => 'Essential information every vehicle importer should know before starting the import process in Tanzania.',
                'content' => '<h2>Introduction</h2>
<p>Importing vehicles involves several regulatory procedures. Before importing, individuals and businesses should understand the requirements and processes involved.</p>

<h3>Key Things to Know:</h3>

<h4>Documentation Requirements</h4>
<p>Understand what documents you need including Bill of Lading, commercial invoice, and import permits.</p>

<h4>Import Duties</h4>
<p>Research applicable import duties and taxes based on vehicle value, age, and engine capacity.</p>

<h4>Inspection Procedures</h4>
<p>Be aware that customs authorities may inspect vehicles to verify condition and specifications.</p>

<h4>Cargo Clearance Timelines</h4>
<p>Understand typical clearance timeframes and factors that can affect processing time.</p>

<h4>Vehicle Eligibility</h4>
<p>Check if your vehicle meets Tanzania\'s import regulations regarding age restrictions and specifications.</p>

<h3>Get Professional Guidance</h3>
<p>Professional clearing agents can guide importers through these procedures and ensure compliance with all requirements.</p>',
                'meta_title' => 'What to Know Before Importing Vehicles into Tanzania',
                'meta_description' => 'Essential information every vehicle importer should know before starting the import process in Tanzania.',
                'meta_keywords' => 'vehicle import Tanzania, import requirements, vehicle clearance guide, customs regulations',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(3),
                'views' => rand(180, 550),
            ],
            [
                'category_id' => $tipsCategory->id,
                'title' => 'How to Avoid Delays in Cargo Clearance',
                'slug' => 'how-avoid-delays-cargo-clearance',
                'excerpt' => 'Practical strategies to prevent delays and ensure smooth cargo clearance at Tanzanian ports.',
                'content' => '<h2>Introduction</h2>
<p>Many cargo clearance delays are caused by poor preparation and avoidable mistakes.</p>

<h3>To Avoid Delays:</h3>

<h4>Ensure Documentation is Complete</h4>
<p>Check that all required documents are accurate and complete before cargo arrival.</p>

<h4>Verify Cargo Details Before Shipment</h4>
<p>Ensure cargo descriptions, values, and classifications are correct in shipping documents.</p>

<h4>Work With Professional Clearing Agents</h4>
<p>Experienced clearing agents can identify potential issues before they cause delays.</p>

<h4>Prepare Duties and Taxes in Advance</h4>
<p>Have funds ready for duty payments to avoid delays after assessment.</p>

<h4>Respond Quickly to Customs Queries</h4>
<p>Promptly address any questions or requests from customs authorities.</p>

<h4>Monitor Cargo Status</h4>
<p>Stay informed about your cargo\'s location and clearance status.</p>

<h3>Conclusion</h3>
<p>Proper planning and coordination help ensure smooth cargo clearance without unnecessary delays.</p>

<p>Working with professional clearing agents provides additional assurance that procedures are handled correctly.</p>',
                'meta_title' => 'How to Avoid Delays in Cargo Clearance | Tanzania Import Guide',
                'meta_description' => 'Practical strategies to prevent delays and ensure smooth cargo clearance at Tanzanian ports.',
                'meta_keywords' => 'avoid cargo delays, fast clearance Tanzania, prevent customs delays, smooth import process',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(1),
                'views' => rand(100, 400),
            ],
        ];

        foreach ($blogPosts as $postData) {
            $postData['author_id'] = $author->id;
            
            // Check if post already exists
            $existingPost = BlogPost::withTrashed()->where('slug', $postData['slug'])->first();
            
            if ($existingPost) {
                if ($existingPost->trashed()) {
                    $existingPost->restore();
                }
                $existingPost->update($postData);
                $this->command->info("✓ Updated blog post: {$postData['title']}");
            } else {
                BlogPost::updateOrCreate(
                    ['slug' => $postData['slug']],
                    $postData
                );
                $this->command->info("✓ Created blog post: {$postData['title']}");
            }
        }

        $this->command->info("\n✅ Blog posts seeding completed successfully!");
        $this->command->info("📝 Created/Updated 10 blog posts across 2 categories");
    }
}
