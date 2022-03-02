<?php

namespace App\Http\Controllers\API;

use App\Models\Player;
use App\Models\Server;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class PlayerController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('access_token');
    }

    /**
     * Get information about connected player.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function connect(Request $request): JsonResponse
    {
        $server = Server::find($request->attributes->get('server_id'));
        $player = Player::firstOrNew(
            [
                'server_id' => $server->id,
                'authid' => $request->input('authid'),
                'auth_type' => $request->input('auth_type')
            ],
            [
                'server_id' => $server->id,
                'name' => $request->input('name'),
                'authid' => $request->input('authid'),
                'ip' => $request->input('ip'),
                'auth_type' => $request->input('auth_type')
            ]
        );

        $player->is_online = true;

        if ($player->exists) {
            $status = 'loaded';
            $player->update();
        } else {
            $status = 'created';
            $player->save();
        }

        return Response::json([
            'success' => true,
            'server_id' => $server->id,
            'player_id' => $player->id,
            'instance_status' => $status
        ]);
    }
}
