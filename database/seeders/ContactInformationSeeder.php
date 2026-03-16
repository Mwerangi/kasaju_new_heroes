<?php

namespace Database\Seeders;

use App\Models\ContactInformation;
use Illuminate\Database\Seeder;

class ContactInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'key' => 'company_name',
                'label' => 'Company Name',
                'value' => 'NEW HEROES INTERNATIONAL LIMITED',
                'group' => 'general',
                'type' => 'text',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'address',
                'label' => 'Physical Address',
                'value' => 'Leader House Floor 1 Room 120, Opposite GBP Petro Station, Dar es Salaam, Tanzania',
                'group' => 'general',
                'type' => 'textarea',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'phone1',
                'label' => 'Primary Phone',
                'value' => '+255 625 544 404',
                'group' => 'contact',
                'type' => 'phone',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'key' => 'phone2',
                'label' => 'Secondary Phone',
                'value' => '+255 742 058 897',
                'group' => 'contact',
                'type' => 'phone',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'key' => 'phone3',
                'label' => 'Tertiary Phone',
                'value' => '+255 776 717 081',
                'group' => 'contact',
                'type' => 'phone',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'key' => 'email',
                'label' => 'Email Address',
                'value' => 'info@newheroesintl.com',
                'group' => 'contact',
                'type' => 'email',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'key' => 'whatsapp',
                'label' => 'WhatsApp Number',
                'value' => '+255 625 544 404',
                'group' => 'social',
                'type' => 'phone',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'key' => 'facebook',
                'label' => 'Facebook Page',
                'value' => 'https://facebook.com/newheroesintl',
                'group' => 'social',
                'type' => 'url',
                'order' => 8,
                'is_active' => false,
            ],
            [
                'key' => 'working_hours',
                'label' => 'Working Hours',
                'value' => 'Monday - Friday: 8:00 AM - 5:00 PM, Saturday: 8:00 AM - 1:00 PM',
                'group' => 'general',
                'type' => 'text',
                'order' => 9,
                'is_active' => true,
            ],
        ];

        foreach ($contacts as $contact) {
            ContactInformation::updateOrCreate(
                ['key' => $contact['key']],
                $contact
            );
        }
    }
}
