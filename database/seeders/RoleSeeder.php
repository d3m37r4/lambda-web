<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Administrator']);
        $role->givePermissionTo('enter_control_panel');
        $role->givePermissionTo('manage_settings');
        $role->givePermissionTo('manage_users');
        $role->givePermissionTo('edit_users');
        $role->givePermissionTo('delete_users');
        $role->givePermissionTo('manage_roles');
        $role->givePermissionTo('edit_roles');
        $role->givePermissionTo('delete_roles');
        $role->givePermissionTo('manage_servers');
        $role->givePermissionTo('edit_servers');
        $role->givePermissionTo('delete_servers');

        $role = Role::create(['name' => 'Moderator']);
        $role->givePermissionTo('enter_control_panel');

        Role::create(['name' => 'User']);
    }
}
