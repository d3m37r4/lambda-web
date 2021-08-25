<?php

namespace App\Helpers;

use App\Models\AccessToken;
use Str;

class HelperAccessToken {
    /**
     * Generate a unique access token for server.
     *
     * @param $lenght
     * @return string
     */
    public static function generateAccessToken($lenght): string {
        do {
            $token = Str::random($lenght);
        } while (AccessToken::where('token', $token)->exists());
        return $token;
    }
}
