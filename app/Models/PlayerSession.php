<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find(mixed $input)
 * @method static create(array $array)
 * @method static where(array $array)
 * @property int id
 * @property int server_id
 * @property string status
 * @property Carbon created_at
 * @property Carbon disconnected_at
 * @property Carbon time
 */
class PlayerSession extends Model
{
    const STATUS_ONLINE = 'online';
    const STATUS_OFFLINE = 'offline';

    use Prunable;

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
    protected $casts = [
        'player_id' => 'int',
        'server_id' => 'int'
    ];

    /**
     * Deleting inactive sessions for last month.
     *
     * @return Builder
     */
    public function prunable(): Builder
    {
        return static::where([
            ['status', PlayerSession::STATUS_OFFLINE],
            ['created_at', '<', Carbon::now()->subMonth()]
        ]);
    }

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
     * Closes the specified session.
     *
     * @return void
     */
    public function close()
    {
        $this->status = PlayerSession::STATUS_OFFLINE;
        $this->disconnected_at = now();
        $this->save();
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
