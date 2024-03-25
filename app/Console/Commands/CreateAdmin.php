<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user for the project';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'SuperAdmin']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        $viewAllPermission = Permission::firstOrCreate(['name' => 'view_all']);

        $superAdminRole->givePermissionTo($viewAllPermission);

        $name = 'Superadmin';
        $email = 'admin@admin.com';
        $password = bcrypt('password!123');
        $phone = '085834221231';

        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            $this->error('Admin user already exists!');
            return;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
        ]);

        // Manually set email_verified_at to the current timestamp
        if (!$user->hasVerifiedEmail()) {
            $user->forceFill([
                'email_verified_at' => now(),
            ])->save();

        }


        // Assign roles to the user
        $user->assignRole([$superAdminRole]);

        $this->info('SuperAdmin user created successfully:');
    }
}
