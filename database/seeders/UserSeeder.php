<?php

namespace Database\Seeders;

use App\Models\User;
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
                'name' => 'User' .$i,
                'email' => 'user' .$i. '@mail.com',
                'password' => '12345678',
            ])->assignRole($i === 1 ? 'Administrator' : 'User');
        }
    }
}
