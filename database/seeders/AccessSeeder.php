<?php

namespace Database\Seeders;

use App\Models\GameServer\Access;
use DB;
use Exception;
use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
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

        $accesses = [
            'ban',
            'vip',
            'kick',
            'buymenu',
            'damager',
            'weaponskin',
            'gold_deagle',
            'gold_ak',
            'skin_vip',
            'model_usp',
        ];

        foreach ($servers as $server) {
            foreach ($accesses as $access) {
                Access::create([
                    'game_server_id' => $server,
                    'key' => $access,
                    'description' => "This is original access description: $access",
                ]);
            }
        }
    }
}
