<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@newheroesintl.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'phone' => '+255625544404',
                'is_active' => true,
            ]
        );
        $admin->syncRoles(['super-admin']);

        // Create Content Manager
        $manager = User::updateOrCreate(
            ['email' => 'manager@newheroesintl.com'],
            [
                'name' => 'Content Manager',
                'password' => Hash::make('password'),
                'phone' => '+255742058897',
                'is_active' => true,
            ]
        );
        $manager->syncRoles(['content-manager']);

        // Create Editor
        $editor = User::updateOrCreate(
            ['email' => 'editor@newheroesintl.com'],
            [
                'name' => 'Editor',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
        $editor->syncRoles(['editor']);
    }
}
