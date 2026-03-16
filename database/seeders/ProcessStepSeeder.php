<?php

namespace Database\Seeders;

use App\Models\ProcessStep;
use Illuminate\Database\Seeder;

class ProcessStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $steps = [
            [
                'title' => 'Document Submission',
                'description' => 'Submit all required documents including Bill of Lading, Invoice, Packing List, and other necessary paperwork to initiate the clearing process.',
                'icon' => 'fas fa-file-invoice',
                'step_number' => 1,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Cargo Verification',
                'description' => 'Our team verifies cargo details at the port, ensuring all information matches the documentation and meets regulatory requirements.',
                'icon' => 'fas fa-clipboard-check',
                'step_number' => 2,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Customs Declaration',
                'description' => 'Complete and submit customs declaration to Tanzania Revenue Authority (TRA), including duty calculations and payment processing.',
                'icon' => 'fas fa-file-signature',
                'step_number' => 3,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Inspection Coordination',
                'description' => 'Coordinate with relevant authorities for cargo inspection, vehicle inspection, and compliance verification as required.',
                'icon' => 'fas fa-search',
                'step_number' => 4,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Clearance Approval',
                'description' => 'Obtain final clearance approval from customs authorities after all duties are paid and inspections are completed.',
                'icon' => 'fas fa-stamp',
                'step_number' => 5,
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Cargo Release',
                'description' => 'Process cargo release from port or terminal, handle all gate passes and release documentation.',
                'icon' => 'fas fa-box-open',
                'step_number' => 6,
                'order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Delivery Coordination',
                'description' => 'Arrange final delivery to your specified location, ensuring safe transportation and timely arrival of your cargo.',
                'icon' => 'fas fa-truck',
                'step_number' => 7,
                'order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($steps as $step) {
            ProcessStep::updateOrCreate(
                ['step_number' => $step['step_number']],
                $step
            );
        }
    }
}
