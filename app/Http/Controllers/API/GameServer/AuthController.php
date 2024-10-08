<?php

namespace App\Http\Controllers\API\GameServer;

use App\Models\GameServer\GameServer;
use App\Models\GameServer\AccessToken;
use App\Http\Controllers\Controller;
use App\Exceptions\GameServerApiException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\API\GameServer\AuthRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    /**
     * Handle an authorization the game server request to the application.
     *
     * @param AuthRequest $request
     * @return JsonResponse
     * @throws GameServerApiException
     */
    public function __invoke(AuthRequest $request): JsonResponse
    {
        $gameServer = $this->getGameServer($request);
        $authToken = $request->header('Server-Auth-token');

        if ($this->attemptAuthorizationGameServer($gameServer, $authToken)) {
            return $this->sendResponseOnAuthorization($gameServer);
        }

        return $this->sendResponseOnFailedAuthorization();
    }

    /**
     * Gets an instance of game server model based on request.
     *
     * @param Request $request
     * @return GameServer
     * @throws GameServerApiException
     */
    protected function getGameServer(Request $request): GameServer
    {
        $ip = $request->header('Server-Ip');
        $port = $request->header('Server-Port');

        if ($request->ip() !== $ip) {
            throw new GameServerApiException('IP address of the request does not match the IP address of the game server.', ResponseAlias::HTTP_FORBIDDEN);
        }

        return GameServer::where([
            ['ip', $ip],
            ['port', $port]
        ])->firstOr(function () {
            throw new GameServerApiException('Game server not found.', ResponseAlias::HTTP_NOT_FOUND);
        });
    }

    /**
     * Attempt to auth the game server into the application.
     *
     * @param GameServer $gameServer
     * @param string $authToken
     * @return bool
     * @throws GameServerApiException
     */
    protected function attemptAuthorizationGameServer(GameServer $gameServer, string $authToken): bool
    {
        if (empty($authToken)) {
            throw new GameServerApiException('Authorization token is required.', ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }

        return Hash::check($authToken, $gameServer->auth_token);
    }

    /**
     * Send the response after the game server was authorized.
     *
     * @param  GameServer $gameServer
     * @return JsonResponse
     */
    protected function sendResponseOnAuthorization(GameServer $gameServer): JsonResponse
    {
        ['access_token' => $accessToken, 'plain_token' => $plainToken] = AccessToken::create([
            'game_server_id' => $gameServer->id
        ]);
        $gameServer->update(['active' => true]);

        return Response::json([
            'access_token' => [
                'game_server_id' => $accessToken->game_server_id,
                'token' => $plainToken,
                'expires_at' => $accessToken->expires_at,
            ]
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Gets an instance of response with an error on authorization.
     *
     * @throws GameServerApiException
     */
    protected function sendResponseOnFailedAuthorization()
    {
//        TODO: Add logging.
//        \Log::warning('Unauthorized access attempt to the game server.');
        throw new GameServerApiException('Game server is unauthorized.', ResponseAlias::HTTP_UNAUTHORIZED);
    }
}
