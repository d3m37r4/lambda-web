<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AccessToken;
use App\Exceptions\InvalidAccessTokenException;

class AccessTokenMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws InvalidAccessTokenException
     */
    public function handle(Request $request, Closure $next) {
        $accessTokenString = $request->header('X-Access-Token');
        if (empty($accessTokenString)) {
            throw new InvalidAccessTokenException('Access token required', 400);
        }

        $accessToken = AccessToken::where('token', $accessTokenString)
            ->firstOr(function() {
            throw new InvalidAccessTokenException('Invalid token', 404);
        });

        $server = $accessToken->server;

        // Should request ip be checked against server ip?
        if ($accessToken->expires_in <= Carbon::now()) {
            $server->update(['active' => false]);
            throw new InvalidAccessTokenException('Bad access token', 403);
        }

        $request->attributes->set('server_id', $server->id);

        return $next($request);
    }
}
