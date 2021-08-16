<?php

namespace App\Http\Controllers\API;

use App\Models\Map;
use App\Models\Server;
use App\Models\AccessToken;
use App\Http\Controllers\Controller;
use App\Helpers\HelperAccessToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Exception;

class ServerController extends Controller {
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('api-server-auth')->except('auth');
    }

    /**
     * Get a token via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function auth(Request $request): JsonResponse {
        // mb firstOr?????
        // https://laravel.demiart.ru/secret-method-firstor/
        $server = Server::where([
            ['ip', $request->ip()],
            ['port', $request->input('port')],
        ])->firstOrFail();      // Need custom message!

//        if (empty($server)) {
//            return Response::json(['message' =>'Server not found'], 404);
//        }

        $authToken = $request->input('auth_token');
        if (empty($authToken)) {
            return Response::json(['message' =>'Token required'], 400);
        }

        if (!Hash::check($authToken, $server->auth_token)) {
            return Response::json(['message' => 'Unauthorized'], 401);
        }

        AccessToken::updateOrCreate(
            ['server_id' => $server->id],
            ['token' => HelperAccessToken::generateAccessToken(64), 'expires_in' => now()->addHours(12)],
        );

        return Response::json([
            'access_token' => $server->access_token_string,
            'expires_in' => $server->access_token_expires_in,
        ]);
    }

    /**
     * Gets information about server when a new map is launched or when server is started.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function info(Request $request): JsonResponse {
        $server = Server::find($request->attributes->get('server_id'));

        if ($request->has('map')) {
            $map = Map::firstOrCreate(
                ['name' => $request->query('map')],
                ['name' => $request->query('map')],
            );
            $server->map_id = $map->id;
        }

        $server->save();

        return Response::json([
            'success' => true,
            'server_id' => $server->id,
            'map' => $server->map_name,
            'time' => time(),
        ]);
    }
}
