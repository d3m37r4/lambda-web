<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++)  {
            $role = Role::findByName($i === 1 ? User::ROLE_OWNER : User::DEFAULT_USER_ROLE);
            $user = User::create([
                'login' => 'User' .$i,
                'email' => 'user' .$i. '@mail.com',
                'password' => '123123',
            ]);
            $user->assignRole($role);
            $user->givePermissionTo($role->permissions);
        }
    }
}
