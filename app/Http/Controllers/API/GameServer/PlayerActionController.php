<?php

namespace App\Http\Controllers\API\GameServer;

use App\Http\Controllers\Controller;
use App\Models\GameServer\GameServer;
use App\Models\GameServer\Player;
use App\Services\PlayerAction;
use App\Services\PlayerSessionAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PlayerActionController extends Controller
{
    /**
     * Get information about connected player.
     *
     * @param Request $request
     * @param GameServer $server
     * @return JsonResponse
     */
    public function connect(Request $request, GameServer $server): JsonResponse
    {
        // TODO: Add request validator
        $player = PlayerAction::findOrCreate($server, $request);
        PlayerAction::setCurrentName($player, $request);

        $action = PlayerAction::getAction($player);
        $session = PlayerSessionAction::getActiveSession($server, $player);
        $server->update();  // To update online players

        return Response::json([
            'player_id' => $player->id,
            'session_id' => $session->id,
            'action' => $action
        ]);
    }

    /**
     * Assigns a user profile to the game account.
     *
     * @param Request $request
     * @param GameServer $server
     * @param Player $player
     * @return void
     */
    public function assign(Request $request, GameServer $server, Player $player): void
    {

    }

    /**
     * Updates information about disconnected player.
     *
     * @param Request $request
     * @param GameServer $server
     * @param Player $player
     * @return JsonResponse
     */
    public function disconnect(Request $request, GameServer $server, Player $player): JsonResponse
    {
        // TODO: Add request validator
        PlayerAction::setCurrentName($player, $request);

        $player->active_session->close();
        $server->update();  // To update online players

        return Response::json();
    }
}
