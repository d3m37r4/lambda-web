<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiTokenMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        $accessTokenString = $request->header('X-Access-Token');
        if (empty($accessTokenString)) {
            return Response::json(['message' => 'Access token required'], 400);
        }

        $accessToken = AccessToken::where('token', $accessTokenString)
            ->firstOrFail();    // Need custom message!
        // Should request ip be checked against server ip?
        // added check token expires time
//        if (empty($accessToken)) {
//            return Response::json(['message' =>'Invalid token'], 404);
//        }

        $request->attributes->set('server_id', $accessToken->server->id);
        return $next($request);
    }
}
