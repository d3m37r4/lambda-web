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
        for ($i = 1; $i <= 10; $i++)
        {
            $user = User::create([
                'name' => 'User' .$i,
                'email' => 'user' .$i. '@mail.com',
                'password' => bcrypt('12345678'),
            ]);
            $user->assignRole($i === 1 ? 'Administrator' : 'User');
        }
    }
}
