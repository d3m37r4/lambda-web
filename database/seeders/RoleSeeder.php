<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => Role::ROLE_OWNER])->givePermissionTo([
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
        Role::create(['name' => Role::ROLE_ADMIN])->givePermissionTo([
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
        Role::create(['name' => Role::ROLE_MODER])->givePermissionTo('enter_control_panel');
        Role::create(['name' => Role::ROLE_USER]);
    }
}
