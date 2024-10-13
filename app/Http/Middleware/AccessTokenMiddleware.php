<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\GameServer\AccessToken;
use App\Exceptions\GameServerApiException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AccessTokenMiddleware
{
    /**
     * Handle an incoming request from the game server.
     *
     * @throws GameServerApiException
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('User-Agent') !== 'Lambda') {
            return throw new GameServerApiException('Invalid User-Agent', Response::HTTP_FORBIDDEN);
        }

        $accessTokenHeader = $request->header(AccessToken::ACCESS_TOKEN_HEADER);
        $accessToken = AccessToken::all()->first(function ($token) use ($accessTokenHeader) {
            return Hash::check($accessTokenHeader, $token->token);
        });

        if (!$accessToken) {
            throw new GameServerApiException('Invalid access token.', Response::HTTP_NOT_FOUND);
        }

        $gameServer = $accessToken->gameServer;

        if (!$gameServer) {
            throw new GameServerApiException('Server not found.', Response::HTTP_NOT_FOUND);
        }

        if ($accessToken->expires_at->isPast()) {
            $gameServer->update(['active' => false]);
            throw new GameServerApiException('Access token expired.', Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
