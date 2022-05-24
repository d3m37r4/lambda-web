<?php

namespace App\Http\Controllers\API;

use Arr;
use App\Models\Map;
use App\Models\Server;
use App\Http\Requests\API\GameServerInfoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class GameServerActionsController extends Controller
{
    /**
     * Gets information about server when a new map is launched or when server is started.
     *
     * @param GameServerInfoRequest $request
     * @param Server $server
     * @return JsonResponse
     */
    public function info(GameServerInfoRequest $request, Server $server): JsonResponse
    {
        $response = array();
        $server->max_players = $request->input('max_players');
        $server->map_id = Map::firstOrCreate(['name' => $request->input('map')])->id;
        $response = Arr::add($response, 'map', $server->map_id);
        $nextUpdate = now()->addHours(12)->timestamp;

        if ($request->boolean('update_reasons')) {
            $response = Arr::add($response, 'reasons_data', [
                'reasons' => $server->reasons,
                'next_update' => $nextUpdate
            ]);
        }

        if ($request->boolean('update_access_groups')) {
            $response = Arr::add($response, 'access_groups_data', [
                'access_groups' => $server->access_groups,
                'next_update' => $nextUpdate
            ]);
        }

        $response = Arr::add($response, 'time', now()->timestamp);
        $server->update();

        return Response::json($response);
    }

    /**
     * Gets additional information about server.
     *
     * @param Request $request
     * @param Server $server
     * @return JsonResponse
     */
    public function ping(Request $request, Server $server): JsonResponse {
        $server->update();

        return Response::json([
            'success' => true,
        ]);
    }
}
