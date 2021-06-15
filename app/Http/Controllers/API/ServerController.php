<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Server;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ServerController extends Controller {
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('api-server-auth', ['except' => 'auth']);
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
            return response()->json(['message' =>'Server not found'], 404);
        }

        $authToken = $request->input('auth_token');
        if (empty($authToken)) {
            return response()->json(['message' =>'Token required'], 400);
        }

        if (!Hash::check($authToken, $server->auth_token)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $server->access_token = $this->generateAccessToken();
        $server->access_token_expires = now()->addHours(12);
        $server->save();

        $response = [
            'access_token' => $server->access_token,
            'expires_in' => $server->access_token_expires,
        ];

        return response()->json($response);
    }

    public function test(Request $request): JsonResponse {
        $testString = $request->input('test_string');
        $server = Server::find($request->get('id'));

        $response = [
            'test_string' => $testString,
            'server' => $server,
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
