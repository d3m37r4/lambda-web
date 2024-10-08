<?php

namespace App\Models\GameServer;

use App\Helpers\Token;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessToken extends Model
{
    /**
     * HTTP request header name.
     *
     * @var string
     */
    const ACCESS_TOKEN_HEADER = 'Lambda-X-Access-Token';

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
    const ACCESS_TOKEN_LIFETIME_HOURS = 12;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = ['token', 'game_server_id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['token', 'expires_at', 'game_server_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'expires_at' => 'timestamp'
    ];

    /**
     * Gets server available for a specific game server.
     *
     * @return BelongsTo
     */
    public function gameServer(): BelongsTo
    {
        return $this->belongsTo(GameServer::class);
    }

    /**
     * Create a new AccessToken instance and invalidate previous tokens for the same game server.
     *
     * @param array $attributes The attributes to create the AccessToken with.
     * @return array
     */
    public static function create(array $attributes = []): array
    {
        $gameServerId = $attributes['game_server_id'];
        self::where('game_server_id', $gameServerId)->delete();

        $plainToken = Token::generate(self::MAX_ACCESS_TOKEN_LENGTH, 'access_tokens');
        $hashedToken = bcrypt($plainToken);

        $attributes['token'] = $hashedToken;
        $attributes['expires_at'] = now()->addHours(self::ACCESS_TOKEN_LIFETIME_HOURS);

        $accessToken = static::query()->create($attributes);

        return ['access_token' => $accessToken, 'plain_token' => $plainToken];
    }
}
