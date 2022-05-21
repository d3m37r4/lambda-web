<?php

namespace App\Http\Controllers\API;

use App\Models\Server;
use App\Helpers\HelperAccessToken;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\GameServerAuthRequest;
use App\Exceptions\GameServerApiException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class GameServerAuthController extends Controller
{
    /**
     * Handle a authorization the game server request to the application.
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
     * @return Server
     * @throws GameServerApiException
     */
    protected function getGameServer(Request $request): Server
    {
        return Server::where([
            ['ip', $request->ip()],
            ['port', $request->input('port')]
        ])->firstOr(function () {
            throw new GameServerApiException('Game server not found.', JsonResponse::HTTP_NOT_FOUND);
        });
    }

    /**
     * Attempt to auth the game server into the application.
     *
     * @param Server $server
     * @param string $authToken
     * @return bool
     */
    protected function attemptAuthorizationGameServer(Server $server, string $authToken): bool
    {
        return Hash::check($authToken, $server->auth_token);
    }

    /**
     * Send the response after the game server was authorized.
     *
     * @param  Server $server
     * @return JsonResponse
     */
    protected function sendResponseOnAuthorization(Server $server): JsonResponse
    {
        $server->access_token()->updateOrCreate(
            ['server_id' => $server->id],
            [
                'token' => HelperAccessToken::generateToken(),
                'expires_in' => HelperAccessToken::createExpiresDate()
            ]
        );
        $server->update(['active' => true]);

        return Response::json(['access_token' => $server->access_token], JsonResponse::HTTP_OK);
    }

    /**
     * Gets an instance of response with an error on authorization.
     *
     * @throws GameServerApiException
     */
    protected function sendResponseOnFailedAuthorization() {
        return throw new GameServerApiException('Game server is unauthorized',JsonResponse::HTTP_UNAUTHORIZED);
    }
}
