<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Role::create(['name' => User::ROLE_OWNER]);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => User::ROLE_ADMIN]);
        $role->givePermissionTo([
            'enter_control_panel',
            'manage_settings',
            'manage_users',
            'edit_users',
            'delete_users',
            'manage_roles',
            'edit_roles',
            'delete_roles',
            'manage_servers',
            'edit_servers',
            'delete_servers'
        ]);
        $role = Role::create(['name' => User::ROLE_MODER]);
        $role->givePermissionTo('enter_control_panel');
        Role::create(['name' => User::ROLE_USER]);
    }
}
