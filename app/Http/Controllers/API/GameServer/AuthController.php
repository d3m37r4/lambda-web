<?php

namespace App\Http\Controllers\API\GameServer;

use App\Exceptions\GameServerApiException;
use App\Helpers\HelperAccessToken;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\GameServerAuthRequest;
use App\Models\GameServer\GameServer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    /**
     * Handle an authorization the game server request to the application.
     *
     * @param GameServerAuthRequest $request
     * @return JsonResponse
     * @throws GameServerApiException
     */
    public function __invoke(GameServerAuthRequest $request): JsonResponse
    {
        $server = $this->getGameServer($request);
        $authToken = $request->input('auth_token');

        if ($this->attemptAuthorizationGameServer($server, $authToken)) {
            return $this->sendResponseOnAuthorization($server);
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
        return GameServer::where([
            ['ip', $request->ip()],
            ['port', $request->input('port')]
        ])->firstOr(function () {
            throw new GameServerApiException('Game server not found.', ResponseAlias::HTTP_NOT_FOUND);
        });
    }

    /**
     * Attempt to auth the game server into the application.
     *
     * @param GameServer $server
     * @param string $authToken
     * @return bool
     */
    protected function attemptAuthorizationGameServer(GameServer $server, string $authToken): bool
    {
        return Hash::check($authToken, $server->auth_token);
    }

    /**
     * Send the response after the game server was authorized.
     *
     * @param  GameServer $server
     * @return JsonResponse
     */
    protected function sendResponseOnAuthorization(GameServer $server): JsonResponse
    {
        $server->access_token()->updateOrCreate(
            ['server_id' => $server->id],
            [
                'token' => HelperAccessToken::generateToken(),
                'expires_in' => HelperAccessToken::createExpiresDate()
            ]
        );
        $server->update(['active' => true]);

        return Response::json(['access_token' => $server->access_token], ResponseAlias::HTTP_OK);
    }

    /**
     * Gets an instance of response with an error on authorization.
     *
     * @throws GameServerApiException
     */
    protected function sendResponseOnFailedAuthorization() {
        return throw new GameServerApiException('Game server is unauthorized', ResponseAlias::HTTP_UNAUTHORIZED);
    }
}
