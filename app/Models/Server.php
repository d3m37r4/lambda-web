<?php

namespace App\Models;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;

/**
 * @method static create(array $array)
 * @method static paginate(mixed $env)
 * @method static find(array|Application|Request|string|null $request)
 * @method static where(array[] $array)
 * @property int id
 * @property int port
 * @property int num_players
 * @property int max_players
 * @property string name
 * @property string ip
 * @property string rcon
 * @property string auth_token
 * @property array map
 * @property array reasons
 * @property array access_token
 */
class Server extends Model {
    /**
     * @var array
     */
    protected $fillable = ['name', 'ip', 'port', 'rcon', 'map_id', 'auth_token', 'num_players', 'max_players'];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $hidden = ['rcon', 'auth_token', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $appends = [
        'full_address',
        'map_name',
        'access_token_string',
        'access_token_expires_in',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'port' => 'int',
        'map_id' => 'int',
        'num_players' => 'int',
        'max_players' => 'int',
        'full_address' => 'string',
        'map_name' => 'string',
        'access_token_string' => 'string',
        'access_token_expires_in' => 'datetime',
    ];

    /**
     * Gets access token available for a specific server.
     *
     * @return HasOne
     */
    public function access_token(): HasOne {
        return $this->hasOne(AccessToken::class);
    }

    /**
     * Gets map available for a specific server.
     *
     * @return BelongsTo
     */
    public function map(): BelongsTo {
        return $this->belongsTo(Map::class);
    }

    /**
     * Gets reasons available for a specific server.
     *
     * @return HasMany
     */
    public function reasons(): HasMany {
        return $this->hasMany(Reason::class);
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

    /**
     * Gets an access token in string format.
     *
     * @return string
     */
    public function getAccessTokenStringAttribute(): string {
        return $this->access_token['token'];
    }

    /**
     * Gets expiration time of access token.
     *
     * @return int
     */
    public function getAccessTokenExpiresInAttribute(): int {
        return $this->access_token['expires_in']->getTimestamp();
    }
}
