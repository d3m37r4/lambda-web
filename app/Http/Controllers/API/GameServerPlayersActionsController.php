<?php

namespace App\Http\Controllers\API;

use App\Models\Server;
use App\Models\Player;
use App\Services\PlayerAction;
use App\Services\PlayerSessionAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class GameServerPlayersActionsController extends Controller
{
    /**
     * Get information about connected player.
     *
     * @param Request $request
     * @param Server $server
     * @return JsonResponse
     */
    public function connect(Request $request, Server $server): JsonResponse
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
     * @param Server $server
     * @param Player $player
     * @return JsonResponse
     */
    public function assign(Request $request, Server $server, Player $player): JsonResponse
    {

    }

    /**
     * Updates information about disconnected player.
     *
     * @param Request $request
     * @param Server $server
     * @param Player $player
     * @return JsonResponse
     */
    public function disconnect(Request $request, Server $server, Player $player): JsonResponse
    {
        // TODO: Add request validator
        PlayerAction::setCurrentName($player, $request);

        $player->active_session->close();
        $server->update();  // To update online players

        return Response::json();
    }
}
