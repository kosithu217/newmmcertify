<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\AdminPermission;

class SetupAdminPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:setup-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup admin permissions for existing admin users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $adminUsers = User::role('admin')->whereDoesntHave('adminPermission')->get();

        if ($adminUsers->isEmpty()) {
            $this->info('All admin users already have permissions set up.');
            return;
        }

        foreach ($adminUsers as $admin) {
            AdminPermission::create([
                'user_id' => $admin->id,
                'menu_permissions' => [],
                'is_super_admin' => true
            ]);

            $this->info("Set up super admin permissions for: {$admin->name} ({$admin->email})");
        }

        $this->info('Admin permissions setup completed!');
    }
}