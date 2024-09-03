<?php

namespace App\Services;

use App\Models\GameServer\GameServer;
use App\Models\GameServer\Player;
use App\Models\GameServer\PlayerSession;

class PlayerSessionAction
{
    /**
     * Gets an active session by server and player.
     *
     * @param GameServer $server
     * @param Player $player
     * @return PlayerSession
     */
    public static function getActiveSession(GameServer $server, Player $player): PlayerSession
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
     * @param GameServer $server
     * @param Player $player
     * @return PlayerSession
     */
    public static function createSession(GameServer $server, Player $player): PlayerSession
    {
        return PlayerSession::create([
            'player_id' => $player->id,
            'server_id' => $server->id,
            'status' => PlayerSession::STATUS_ONLINE,
            'disconnected_at' => null
        ]);
    }
}
