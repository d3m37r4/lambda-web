<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 * @property string title
 */
class AccessGroup extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['server_id', 'title', 'flags', 'prefix'];

    /**
     * @var array
     */
    protected $casts = [
        'server_id' => 'int',
        'title' => 'string',
        'flags' => 'string',
        'prefix' => 'string',
    ];

    /**
     * @var array
     */
    protected $hidden = ['server_id', 'created_at', 'updated_at'];

    /**
     * Gets servers associated with this access group.
     *
     * @return BelongsTo
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }
}
