<?php

namespace App\Services;

use App\Models\Server;
use App\Models\Player;
use App\Models\PlayerSession;

class PlayerSessionAction
{
    /**
     * Gets an active session by server and player.
     *
     * @param Server $server
     * @param Player $player
     * @return PlayerSession
     */
    public static function getActiveSession(Server $server, Player $player): PlayerSession
    {
        $session = $player->active_session;

        if (isset($session)) {
            if ($session->server_id != $server->id) {
                $session->close();
                return PlayerSessionAction::createSession($server, $player);
            }
        }

        return PlayerSessionAction::createSession($server, $player);
    }

    /**
     * Creates an active session for the server and the player.
     *
     * @param Server $server
     * @param Player $player
     * @return PlayerSession
     */
    public static function createSession(Server $server, Player $player): PlayerSession
    {
        return PlayerSession::create([
            'player_id' => $player->id,
            'server_id' => $server->id,
            'status' => PlayerSession::STATUS_ONLINE,
            'disconnected_at' => null
        ]);
    }
}
