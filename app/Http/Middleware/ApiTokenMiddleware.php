<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Server;

class ApiTokenMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): JsonResponse {
        $accessToken = $request->header('X-Access-Token');

        if (empty($accessToken)) {
            return response()->json(['message' => 'Access token required'], 400);
        }

        $server = Server::where('access_token', $accessToken)->first();
        // Should request ip be checked against server ip?
        if (empty($server)) {
            return response()->json(['message' =>'Invalid token'], 404);
        }

        $request->attributes->set('id', $server->id);
        return $next($request);
    }
}
