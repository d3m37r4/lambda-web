<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 * @property string key
 */
class Access extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['server_id', 'key', 'description'];

    /**
     * @var array
     */
    protected $casts = [
        'server_id' => 'int',
        'key' => 'string',
        'description' => 'string',
    ];

    /**
     * @var array
     */
    protected $hidden = ['server_id', 'created_at', 'updated_at'];

    /**
     * Gets servers associated with this access.
     * @return BelongsTo
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }
}
