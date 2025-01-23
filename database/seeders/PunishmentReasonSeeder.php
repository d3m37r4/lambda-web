<?php

namespace Database\Seeders;

use DB;
use Exception;
use App\Models\GameServer\PunishmentReason;
use Illuminate\Database\Seeder;

class PunishmentReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        $gameServers = DB::table('game_servers')->pluck('id');

        if (is_null($gameServers)) {
            throw new Exception("Array containing servers indexes is empty!");
        }

        for ($i = 1; $i <= 100; $i++)  {
            PunishmentReason::create([
                'game_server_id' => $gameServers->random(),
                'name' => "Тестовая причина #$i",
                'time' => random_int(0, 3600),
            ]);
        }
    }
}
