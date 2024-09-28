<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\GameServer\AccessToken;
use App\Exceptions\GameServerApiException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessTokenMiddleware
{
    /**
     * Handle an incoming request from the game server.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws GameServerApiException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $token = $this->getAccessToken($request);
        $server = $token->server();

        if ($token->expires_in <= now()->timestamp) {
            $server->update(['active' => false]);
            throw new GameServerApiException('Bad access token.', Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }

    /**
     * Gets an instance of access token model based on request.
     *
     * @param Request $request
     * @return AccessToken
     * @throws GameServerApiException
     */
    protected function getAccessToken(Request $request): AccessToken
    {
        if (empty($request->header(AccessToken::ACCESS_TOKEN_HEADER))) {
            return throw new GameServerApiException('Access token required.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return AccessToken::where('token', $request->header(AccessToken::ACCESS_TOKEN_HEADER))->firstOr(function () {
            return throw new GameServerApiException('Invalid access token.', Response::HTTP_NOT_FOUND);
        });
    }
}
