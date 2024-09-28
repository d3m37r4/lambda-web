<?php

namespace Database\Seeders;

use App\Models\GameServer\GameServer;
use Exception;
use Illuminate\Database\Seeder;

class GameServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++)
        {
            GameServer::create([
                'name' => 'GameServer #' .$i,
                'ip' => '127.0.0.1',
                'port' => (27000 + $i),
            ]);
        }
    }
}
