<?php

namespace App\Helpers;

use App\Models\GameServer\AccessToken;
use Illuminate\Support\Carbon;
use Str;

class HelperAccessToken
{
    /**
     * Generate a unique access token for server.
     *
     * @return string
     */
    public static function generateToken(): string
    {
        do {
            $token = Str::random(AccessToken::MAX_ACCESS_TOKEN_LENGTH);
        } while (AccessToken::where('token', $token)->exists());

        return $token;
    }

    /**
     * Creates the expiration date of the access token.
     *
     * @return Carbon
     */
    public static function createExpiresDate(): Carbon
    {
        return now()->addHours(AccessToken::ACCESS_TOKEN_LITE_TIME);
    }
}
