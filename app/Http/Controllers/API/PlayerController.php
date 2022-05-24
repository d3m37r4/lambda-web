<?php

namespace App\Http\Controllers\API;

use App\Models\PlayerSession;
use App\Models\Player;
use App\Models\Server;
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
     * @return JsonResponse
     */
    public function connect(Request $request): JsonResponse
    {
        // TODO: Add request validator
        $server = Server::find($request->attributes->get('server_id'));
        $player = Player::firstOrNew(
            [
                'server_id' => $server->id,
                'authid' => $request->input('authid'),
                'auth_type' => $request->input('auth_type')
            ],
            [
                'server_id' => $server->id,
                'authid' => $request->input('authid'),
                'ip' => $request->input('ip'),
                'auth_type' => $request->input('auth_type')
            ]
        );

        $player->name = $request->input('name');

        if ($player->exists) {
            $action = 'loaded';
            $player->update();
        } else {
            $action = 'created';
            $player->save();
        }

        if ($request->has('session_id')) {
            $session = PlayerSession::find($request->input('session_id'));
        } else {
            $session = $player->active_session();
        }

        if (!$session) {
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
     * @return JsonResponse
     */
    public function disconnect(Request $request): JsonResponse
    {
        $server = Server::find($request->attributes->get('server_id'));
        $player = Player::find($request->input('player_id'));
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
