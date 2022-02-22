<?php

namespace Database\Seeders;

use Arr;
use DB;
use Exception;
use Illuminate\Database\Seeder;
use App\Models\AccessGroup;

class AccessGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $servers = DB::table('servers')->pluck('id');

        if (is_null($servers)) {
            throw new \Exception("Array containing servers indexes is empty!");
        }

        $accessGroups = [
            [
                'name' => 'Владелец',
                'flags' => 'abcdefghijklmnopqrstuvwxyz',
                'prefix' => 'Owner',
            ],
            [
                'name' => 'Администратор',
                'flags' => 'abcdefghijkl',
                'prefix' => 'Admin',
            ],
            [
                'name' => 'Модератор',
                'flags' => 'abcdef',
                'prefix' => 'Moder',
            ],
            [
                'name' => 'Вип-игрок',
                'flags' => 'abt',
                'prefix' => 'Vip',
            ],
        ];

        foreach ($servers as $server) {
            foreach ($accessGroups as $accessGroup) {
                AccessGroup::create([
                    'server_id' => $server,
                    'title' => Arr::get($accessGroup, 'name'),
                    'flags' => Arr::get($accessGroup, 'flags'),
                    'prefix' => Arr::get($accessGroup, 'prefix'),
                ]);
            }
        }
    }
}
