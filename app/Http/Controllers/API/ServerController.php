<?php

namespace App\Http\Controllers\API;

use Arr;
use App\Models\Map;
use App\Models\Server;
use App\Models\AccessToken;
use App\Helpers\HelperAccessToken;
use App\Http\Requests\API\ServerInfoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class ServerController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('api_server_auth')->except('auth');
    }

    /**
     * Get a token via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function auth(Request $request): JsonResponse
    {
        $server = Server::where([
            ['ip', $request->ip()],
            ['port', $request->input('port')]
        ])->firstOr(function () {
            return Response::json(['error' => 'Server not found'], JsonResponse::HTTP_NOT_FOUND);
        });

        $authToken = $request->input('auth_token');
        if (empty($authToken)) {
            return Response::json(['error' => 'Token required'], JsonResponse::HTTP_BAD_REQUEST);
        }

        if (!Hash::check($authToken, $server->auth_token)) {
            $server->update(['active' => false]);
            return Response::json(['error' => 'Unauthorized'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $accessToken = AccessToken::updateOrCreate(
            ['server_id' => $server->id],
            ['token' => HelperAccessToken::generateAccessToken(64), 'expires_in' => now()->addHours(12)]
        );
        $server->update(['active' => true]);

        return Response::json([
            'success' => true,
            'access_token' => $accessToken
        ]);
    }

    /**
     * Gets information about server when a new map is launched or when server is started.
     *
     * @param ServerInfoRequest $request
     * @return JsonResponse
     */
    public function info(ServerInfoRequest $request): JsonResponse
    {
        $server = Server::find($request->attributes->get('server_id'));
        $time = now();
        $response = [
            'success' => true,
            'server_id' => $server->id
        ];
        $server->max_players = $request->input('max_players');
        $server->map_id = Map::firstOrCreate(
            ['name' => $request->input('map')],
            ['name' => $request->input('map')]
        )->id;
        $response = Arr::add($response, 'map', $server->map_id);

        if ($request->boolean('update_reasons')) {
            $response = Arr::add($response, 'reasons_data', [
                'reasons' => $server->reasons,
                'next_update' => $time->addHours(12)->timestamp
            ]);
        }

        $response = Arr::add($response, 'time', $time->timestamp);
        $server->update();

        return Response::json($response);
    }

    /**
     * Gets additional information about server.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function ping(Request $request): JsonResponse {
        $server = Server::find($request->attributes->get('server_id'));

        // mb add validator?
        if ($request->has('num_players')) {
            $server->num_players = $request->input('num_players');
        }

        $server->update();

        return Response::json([
            'success' => true,
        ]);
    }
}
