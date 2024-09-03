<?php

namespace Database\Seeders;

use App\Models\GameServer\Reason;
use DB;
use Exception;
use Illuminate\Database\Seeder;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        $servers = DB::table('game_servers')->pluck('id');

        if (is_null($servers)) {
            throw new Exception("Array containing servers indexes is empty!");
        }

        for ($i = 1; $i <= 100; $i++)  {
            Reason::create([
                'game_server_id' => $servers->random(),
                'title' => "Тестовая причина #$i",
                'time' => random_int(0, 3600),
            ]);
        }
    }
}
