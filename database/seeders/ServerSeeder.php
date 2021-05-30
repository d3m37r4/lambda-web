<?php

namespace Database\Seeders;

use App\Models\Server;
use Exception;
use Illuminate\Database\Seeder;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        for ($i = 1; $i <= 30; $i++)
        {
            Server::create([
                'name' => 'Server #' .$i,
                'ip' => '127.0.0.1',
                'port' => (27000 + $i),
                'active' => 0,
            ]);
        }
    }
}
