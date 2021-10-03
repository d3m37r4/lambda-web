<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $token)
 * @method static updateOrCreate(array $array, array $array1)
 */
class AccessToken extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $dates = ['expires_in'];

    /**
     * @var array
     */
    protected $hidden = ['id', 'server_id'];

    /**
     * @var array
     */
    protected $casts = [
        'expires_in' => 'timestamp',
    ];

    /**
     * Gets server available for a specific server.
     *
     * @return BelongsTo
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }
}
