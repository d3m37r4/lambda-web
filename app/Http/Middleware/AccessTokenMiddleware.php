<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\AccessToken;
use App\Exceptions\InvalidAccessTokenException;

class AccessTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws InvalidAccessTokenException
     */
    public function handle(Request $request, Closure $next)
    {
        $accessTokenString = $request->header('X-Access-Token');
        if (empty($accessTokenString)) {
            throw new InvalidAccessTokenException('Access token required.', JsonResponse::HTTP_BAD_REQUEST);
        }

        $accessToken = AccessToken::where('token', $accessTokenString)->firstOr(function () {
            throw new InvalidAccessTokenException('Invalid token.', JsonResponse::HTTP_NOT_FOUND);
        });

        $server = $accessToken->server;

        // Should request ip be checked against server ip?
        if ($accessToken->expires_in <= now()->timestamp) {
            $server->update(['active' => false]);
            throw new InvalidAccessTokenException('Bad access token.', JsonResponse::HTTP_FORBIDDEN);
        }

        $request->attributes->set('server_id', $server->id);

        return $next($request);
    }
}
