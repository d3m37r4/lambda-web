<?php

namespace App\Models\GameServer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 * @method static create(array $array)
 * @method static paginate(mixed $env)
 * @method static whereIn(mixed $var1, mixed $var2)
 * @property int $id
 * @property int $port
 * @property string $name
 * @property string $ip
 * @property string $auth_token
 * @property string $rcon
 */
class GameServer extends Model
{
    /**
     * The maximum buffer size required to store an auth token.
     *
     * @var int
     */
    const MAX_AUTH_TOKEN_LENGTH = 64;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'ip',
        'port',
        'rcon',
        'map_id',
        'auth_token',
        'max_players',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'rcon',
        'auth_token'
    ];

    /**
     * @var array
     */
    protected $appends = [
        'full_address',
        'num_players',
        'map_name',
        'percent_players'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'port' => 'int',
        'map_id' => 'int',
        'num_players' => 'int',
        'max_players' => 'int',
        'map_name' => 'string',
        'active' => 'boolean',
        'percent_players' => 'int'
    ];

    /**
     * Gets the full address of the game server in the format “ip:port”.
     *
     * @return Attribute
     */
    protected function fullAddress(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->ip . ':' . $this->port
        );
    }


    /**
     * Sets a hash instead of a valid auth token.
     *
     * @return Attribute
     */
    protected function authToken(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value)
        );
    }

    /**
     * Gets access token available for a specific server.
     *
     * @return HasOne
     */
    public function access_token(): HasOne
    {
        return $this->hasOne(AccessToken::class);
    }

    /**
     * Gets a map available for a specific server.
     *
     * @return BelongsTo
     */
    public function map(): BelongsTo
    {
        return $this->belongsTo(Map::class);
    }

    /**
     * Gets reasons available for a specific server.
     *
     * @return HasMany
     */
    public function reasons(): HasMany
    {
        return $this->hasMany(Reason::class);
    }

    /**
     * Gets accesses available for a specific server.
     *
     * @return HasMany
     */
    public function accesses(): HasMany
    {
        return $this->hasMany(Access::class);
    }

    /**
     * Gets access groups available for a specific server.
     *
     * @return HasMany
     */
    public function access_groups(): HasMany
    {
        return $this->hasMany(AccessGroup::class);
    }

    /**
     * Gets players available for a specific server.
     *
     * @return HasMany
     */
    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    /**
     * Gets sessions currently on specified server.
     *
     * @return HasMany
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(PlayerSession::class);
    }

    /**
     * Gets online players currently on specified server.
     *
     * @return Collection
     */
    public function online_players(): Collection
    {
        return Player::select('players.*')
            ->join('players_sessions', 'players.id', '=', 'players_sessions.player_id')
            ->where([
                ['players_sessions.server_id', $this->id],
                ['players_sessions.status', PlayerSession::STATUS_ONLINE]
            ])
            ->limit($this->max_players)
            ->get();
    }

    /**
     * Checks if there are online players for a specific server.
     *
     * @return bool
     */
    public function hasOnlinePlayers(): bool {
        return $this->online_players()->isNotEmpty();
    }

    /**
     * Gets map name.
     *
     * @return string
     */
    public function getMapNameAttribute(): string
    {
        return $this->map['name'] ?? 'Не определена';
    }

    /**
     * Gets players online as a percentage.
     *
     * @return int
     */
    public function getPercentPlayersAttribute(): int
    {
        return $this->active ? (100 * $this->num_players / $this->max_players) : 0;
    }

    /**
     * Gets number of online players for specified server.
     *
     * @note Prevents setting invalid values for online players.
     *       For Counter Strike 1.6, this is 0-32.
     *
     * @return int
     */
    public function getNumPlayersAttribute(): int
    {
        return max(0, min($this->max_players, $this->online_players()->count()));
    }
}
