<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MapSeeder::class);
        $this->call(GameServerSeeder::class);
        $this->call(ReasonSeeder::class);
        $this->call(AccessSeeder::class);
        $this->call(AccessGroupSeeder::class);
        $this->call(CountrySeeder::class);
    }
}
