<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $token)
 * @method static paginate(mixed $env)
 */
class Server extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servers';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['name', 'ip', 'port', 'rcon', 'token'];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $hidden = ['rcon', 'token', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $casts = [
        'port' => 'int',
    ];

    /**
     * @return string
     * @throws Exception
     */
    public function generateSecurityToken(): string {
        $tries = 0;

        do {
            $token = bin2hex(random_bytes(32));
        } while (++$tries < 3 && Server::where('token', $token)->exists());

        return $token;
    }
}
