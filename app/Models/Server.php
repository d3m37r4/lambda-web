<?php

namespace App\Models;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $token)
 * @method static paginate(mixed $env)
 * @method static find(array|Application|Request|string|null $request)
 * @property string name
 * @property string ip
 * @property int port
 * @property string rcon
 * @property string auth_token
 * @property string access_token
 * @property mixed map
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
    protected $fillable = ['name', 'ip', 'port', 'rcon', 'map_id', 'auth_token', 'access_token'];

    /**
     * @var array
     */
    protected $dates = ['access_token_expires', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $hidden = ['rcon', 'auth_token', 'access_token', 'access_token_expires', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $appends = [
        'full_address',
        'map_name',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'port' => 'int',
        'map_id' => 'int',
        'access_token_expires' => 'timestamp',
        'full_address' => 'string',
        'map_name' => 'string',
    ];

    /**
     * @return BelongsTo
     */
    public function map(): BelongsTo {
        return $this->belongsTo(Map::class);
    }

    /**
     * Gets map name.
     *
     * @return string
     */
    public function getMapNameAttribute(): string {
        return $this->map['name'] ?? 'Не определена';
    }

    /**
     * Gets full server address.
     *
     * @return string
     */
    public function getFullAddressAttribute(): string {
        return $this->ip . ':' . $this->port;
    }
}
