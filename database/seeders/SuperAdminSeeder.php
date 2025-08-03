<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AdminPermission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create admin role if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Create super admin user
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@mmcertify.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'approved' => 1,
                'cert_limit' => 0,
            ]
        );

        // Assign admin role
        if (!$superAdmin->hasRole('admin')) {
            $superAdmin->assignRole('admin');
        }

        // Create admin permissions
        AdminPermission::firstOrCreate(
            ['user_id' => $superAdmin->id],
            [
                'menu_permissions' => [],
                'is_super_admin' => true
            ]
        );

        $this->command->info('Super admin created successfully!');
        $this->command->info('Email: admin@mmcertify.com');
        $this->command->info('Password: password123');
    }
}