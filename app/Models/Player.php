<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static firstOrNew(array $array, array $array1)
 * @method static find(mixed $input)
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
    protected $casts = [
        'authid' => 'string',
        'ip' => 'string',
        'auth_type' => 'string'
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
     * @return Model|HasMany|null
     */
    public function active_session()
    {
        return $this->sessions()->firstWhere('status', PlayerSession::STATUS_ONLINE);
    }
}
