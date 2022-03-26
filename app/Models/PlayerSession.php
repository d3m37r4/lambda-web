<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find(mixed $input)
 * @method static create(array $array)
 * @method static where(array $array)
 * @property Carbon created_at
 * @property Carbon disconnected_at
 */
class PlayerSession extends Model
{
    const STATUS_ONLINE = 'online';
    const STATUS_OFFLINE = 'offline';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'players_sessions';

    /**
     * @var array
     */
    protected $fillable = ['player_id', 'server_id', 'status', 'disconnected_at'];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'disconnected_at'];

    /**
     * @var array
     */
    protected $casts = [
        'player_id' => 'int',
        'server_id' => 'int'
    ];

    /**
     * Gets player associated with this session.
     *
     * @return BelongsTo
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * Gets server associated with this session.
     *
     * @return BelongsTo
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }

    /**
     * Gets duration time of specified player session.
     *
     * @return string
     */
    public function getTimeAttribute(): string
    {
        return $this->disconnected_at !== null
            ? $this->disconnected_at->diffForHumans($this->created_at, true, true, 3)
            : Carbon::now()->diffForHumans($this->created_at, true, true, 3);
    }
}
