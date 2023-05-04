<?php

namespace App\Services;

use App\Models\Player;
use App\Models\Server;
use Illuminate\Http\Request;

class PlayerAction
{
    /**
     * Gets an action with an instance of the player model.
     *
     * @param Player $player
     * @return string
     */
    public static function getAction(Player $player): string
    {
        return $player->wasRecentlyCreated ? 'created' : 'loaded';
    }

    /**
     * Updates the player's name.
     *
     * @param Player $player
     * @param Request $request
     */
    public static function setCurrentName(Player $player, Request $request)
    {
        if ($player->getOriginal('name') != $request->input('name')) {
            $player->update(['name' => $request->input('name')]);
        }
    }

    /**
     * Retrieves an instance of the player model or creates a new instance.
     *
     * @param Server $server
     * @param Request $request
     * @return mixed
     */
    public static function findOrCreate(Server $server, Request $request)
    {
        return $server->players()->firstOrCreate(
            [
                'authid' => $request->input('authid'),
                'auth_type' => $request->input('auth_type')
            ],
            [
                'name' => $request->input('name'),
                'ip' => $request->input('ip')
            ]
        );
    }
}
