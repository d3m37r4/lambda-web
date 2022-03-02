<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static firstOrNew(array $array, array $array1)
 * @method static find(mixed $input)
 * @method static where(string $string, int $int)
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
        'auth_type',
        'is_online'
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
        'auth_type' => 'string',
        'is_online' => 'boolean'
    ];

    /**
     * Gets server associated with this player.
     * @return BelongsTo
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }
}
