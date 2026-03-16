<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'manage users',
            'manage roles',
            'manage pages',
            'manage services',
            'manage gallery',
            'manage blog',
            'manage testimonials',
            'manage inquiries',
            'manage settings',
            'view activity logs',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdmin->syncPermissions(Permission::all());

        $contentManager = Role::firstOrCreate(['name' => 'content-manager']);
        $contentManager->syncPermissions([
            'manage pages',
            'manage services',
            'manage gallery',
            'manage blog',
            'manage testimonials',
        ]);

        $editor = Role::firstOrCreate(['name' => 'editor']);
        $editor->syncPermissions([
            'manage pages',
            'manage blog',
        ]);
    }
}
