<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        if (empty($server) || !Hash::check($accessToken, $server->access_token)) {
            return response()->json(['message' =>'Invalid token'], 404);
        }

        return $next($request);
    }
}
