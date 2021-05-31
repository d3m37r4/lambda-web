<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $token)
 * @method static paginate(mixed $env)
 * @property mixed name
 * @property mixed ip
 * @property mixed port
 * @property mixed rcon
 * @property mixed|string token
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
}
