<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AccessToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Exceptions\GameServerApiException;

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
    public function handle(Request $request, Closure $next)
    {
        $token = $this->getAccessToken($request);
        $server = $token->server();

        if ($token->expires_in <= now()->timestamp) {
            $server->update(['active' => false]);
            throw new GameServerApiException('Bad access token.', JsonResponse::HTTP_FORBIDDEN);
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
        if (empty($request->header('X-Access-Token'))) {
            return throw new GameServerApiException('Access token required.', JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        return AccessToken::where('token', $request->header('X-Access-Token'))->firstOr(function () {
            return throw new GameServerApiException('Invalid access token.', JsonResponse::HTTP_NOT_FOUND);
        });
    }
}
