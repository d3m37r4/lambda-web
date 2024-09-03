<?php

namespace App\Models\GameServer;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, string $token)
 * @method static updateOrCreate(array $array)
 * @property Carbon expires_in
 */
class AccessToken extends Model
{
    /**
     * The maximum buffer size required to store an access token.
     *
     * @var int
     */
    const MAX_ACCESS_TOKEN_LENGTH = 64;

    /**
     * Lifetime of the access token, expressed in hours.
     *
     * @var int
     */
    const ACCESS_TOKEN_LITE_TIME = 64;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['token', 'server_id', 'expires_in'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'expires_in' => 'timestamp'
    ];

    /**
     * Gets server available for a specific server.
     *
     * @return BelongsTo
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(GameServer::class);
    }
}
