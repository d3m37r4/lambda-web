<?php

namespace App\Http\Controllers\API\GameServer;

use Arr;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\InfoRequest;
use App\Models\GameServer\GameServer;
use App\Models\GameServer\Map;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ActionController extends Controller
{
    /**
     * Gets information about server when a new map is launched or when the server is started.
     *
     * @param InfoRequest $request
     * @param GameServer $gameServer
     * @return JsonResponse
     */
    public function info(InfoRequest $request, GameServer $gameServer): JsonResponse
    {
        $response = array();
        $gameServer->max_players = $request->input('max_players');
        $gameServer->map_id = Map::firstOrCreate(['name' => $request->input('map')])->id;
        $response = Arr::add($response, 'map', $gameServer->map_id);
        $nextUpdate = now()->addHours(12)->timestamp;

        if ($request->boolean('update_reasons')) {
            $response = Arr::add($response, 'reasons_data', [
                'reasons' => $gameServer->reasons,
                'next_update' => $nextUpdate
            ]);
        }

        if ($request->boolean('update_access_groups')) {
            $response = Arr::add($response, 'access_groups_data', [
                'access_groups' => $gameServer->access_groups,
                'next_update' => $nextUpdate
            ]);
        }

        $response = Arr::add($response, 'time', now()->timestamp);
        $gameServer->update();

        return Response::json($response);
    }

    /**
     * Gets additional information about server.
     *
     * @param Request $request
     * @param GameServer $server
     * @return JsonResponse
     */
    public function ping(Request $request, GameServer $server): JsonResponse {
        $server->update();

        return Response::json([
            'success' => true,
        ]);
    }
}
