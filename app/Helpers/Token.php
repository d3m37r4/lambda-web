<?php

namespace App\Helpers;

use DB;
use Str;

class Token
{
    protected int $length;
    protected string $table;
    protected string $column;

    /**
     * Generates a token consisting of the specified number of random characters.
     *
     * @param int $length The length of the token to generate.
     * @param string $table The table to check for existing tokens.
     * @param string $column The column to check for existing tokens.
     * @param bool $useHashCheck Whether to check the generated token or its hash.
     * If true, the method will check the hash of the token instead of the token itself.
     * This is useful if the token is stored in the database in an encrypted form.
     * @return string The generated unique token.
     *
     * @note If the table and column are specified, the method will generate a unique token
     *       that does not exist in the specified table and column.
     */
    static function generate(int $length, string $table = 'tokens', string $column = 'token', bool $useHashCheck = true): string
    {
        do {
            $token = Str::random($length);
            $valueToCheck = $useHashCheck ? bcrypt($token) : $token;
        } while (DB::table($table)->where($column, $valueToCheck)->exists());

        return $token;
    }
}
