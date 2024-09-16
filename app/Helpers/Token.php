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
     * @param int $length
     * @param string $table
     * @param string $column
     * @return string
     *
     * @note If the table and column are specified, the method will generate a unique token
     *       that does not exist in the specified table and column.
     */
    static function generate(int $length, string $table = 'tokens', string $column = 'token'): string
    {
        do {
            $token = Str::random($length);
        } while (DB::table($table)->where($column, $token)->exists());

        return $token;
    }
}
