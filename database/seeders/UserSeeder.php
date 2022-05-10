<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 30; $i++)  {
            User::create([
                'login' => 'User' .$i,
                'email' => 'user' .$i. '@mail.com',
                'password' => '123123',
            ])->assignRole($i === 1 ? Role::ROLE_OWNER : Role::ROLE_USER);
        }
    }
}
