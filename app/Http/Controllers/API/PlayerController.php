<?php

namespace App\Http\Controllers\API;

use App\Models\Server;
use App\Models\Player;
use App\Models\PlayerSession;
use App\Services\PlayerAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class PlayerController extends Controller
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
        $action = PlayerAction::getAction($player);
        PlayerAction::setCurrentName($player, $request);

        if ($request->has('session_id')) {
            $session = PlayerSession::find($request->input('session_id'));
        } else {
            $session = $player->active_session;
        }

        if (empty($session)) {
            $session = (new PlayerSession)->fill([
                'player_id' => $player->id,
                'server_id' => $server->id,
                'status' => PlayerSession::STATUS_ONLINE,
                'disconnected_at' => null
            ]);
        } else if ($session->server_id != $server->id) {
            $session->status = PlayerSession::STATUS_OFFLINE;
            $session->disconnected_at = now();
            $session->save();

            $session = (new PlayerSession)->fill([
                'player_id' => $player->id,
                'server_id' => $server->id,
                'status' => PlayerSession::STATUS_ONLINE,
                'disconnected_at' => null
            ]);
        }

        // TODO: Make an update of online server in events
        $session->save();
        $server->update();

        return Response::json([
            'success' => true,
            'player_id' => $player->id,
            'session_id' => $session->id,
            'action' => $action
        ]);
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
        $session = PlayerSession::find($request->input('session_id'));

        if ($player && $player->exists) {
            // TODO: Add request validator
            $player->update(['name' => $request->input('name')]);

            if ($session) {
                $session->status = PlayerSession::STATUS_OFFLINE;
                $session->disconnected_at = now();
                $session->save();
            }

            // TODO: Make an update of online server in events
            $server->update();

            return Response::json(['success' => true]);
        }

        return Response::json(['success' => false]);
    }
}
