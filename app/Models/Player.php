<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static firstOrNew(array $array, array $array1)
 * @method static find(mixed $input)
 * @method static where(array[] $array)
 * @method static select(string $string)
 * @property int id
 */
class Player extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'server_id',
        'name',
        'authid',
        'ip',
        'auth_type'
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $appends = [
        'session_time',
        'connection_at'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'authid' => 'string',
        'ip' => 'string',
        'auth_type' => 'string',
        'session_time' => 'string',
        'connection_at' => 'datetime'
    ];

    /**
     * Gets server associated with this player.
     *
     * @return BelongsTo
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }

    /**
     * Gets sessions associated with this player.
     *
     * @return HasMany
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(PlayerSession::class);
    }

    /**
     * Gets active session associated with this player.
     *
     * @return mixed
     */
    public function active_session()
    {
        return PlayerSession::where([
            ['player_id', $this->id],
            ['status', PlayerSession::STATUS_ONLINE]
        ])->first();
    }

    /**
     * Gets the duration time of the active session associated with this player.
     *
     * @note Carbon facade instance converted to string.
     *       See PlayerSession::Class
     *
     * @return string
     */
    public function getSessionTimeAttribute(): string
    {
        return $this->active_session()->time;
    }

    /**
     * Gets time when player joins server.
     *
     * @return Carbon
     */
    public function getConnectedAtAttribute(): Carbon
    {
        return $this->active_session()->created_at;
    }
}
