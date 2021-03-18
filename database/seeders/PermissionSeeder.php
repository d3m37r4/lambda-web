<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'enter_control_panel']);
        Permission::create(['name' => 'manage_settings']);
        Permission::create(['name' => 'manage_users']);
        Permission::create(['name' => 'manage_roles']);
        Permission::create(['name' => 'manage_servers']);
    }
}
