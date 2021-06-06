<?php

namespace App\Http\Controllers\API;

use Carbon\Traits\Date;
use Exception;
use App\Models\Server;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ServerController extends Controller {
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('api-server-auth', ['except' => ['auth']]);
    }

    /**
     * Get a token via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function auth(Request $request): JsonResponse {
        $server = Server::where('ip', $request->ip())
            ->where('port', $request->input('port'))
            ->first();

        if (empty($server)) {
            throw new HttpException(404,'Server not found');
        }

        $authToken = $request->input('auth_token');
        if (empty($authToken)) {
            throw new HttpException(400,'Token required');
        }

        if (!Hash::check($authToken, $server->auth_token)) {
            throw new HttpException(401,'Unauthorized');
        }

        $accessToken = $this->generateAccessToken();

        $server->access_token = Hash::make($accessToken);
        $server->access_token_expires = Date::now()->addHours(12);
        $server->save();

        $response = [
            'access_token' => $accessToken,
            'expires_in' => $server->access_token_expires
        ];

        return response()->json($response);
    }

    /**
     * Generate a unique access token for server.
     *
     * @return string
     * @throws Exception
     */
    protected function generateAccessToken(): string {
        $tries = 0;
        do {
            $token = bin2hex(random_bytes(64));
        } while (++$tries < 3 && Server::where('access_token', $token)->exists());

        return $token;
    }
}
