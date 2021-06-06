<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Server;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
            throw new HttpException(400,'Access token required');
        }

        $server = Server::where('access_token', $accessToken)->first();
        if (empty($server) || !Hash::check($accessToken, $server->access_token)) {
            throw new HttpException(404,'Invalid token');
        }

        return $next($request);
    }
}
