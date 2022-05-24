<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $var)
 * @method static firstOrCreate(mixed $var)
 */
class Map extends Model
{
    /**
     * The maximum buffer size required to store a map's name.
     * See: https://github.com/alliedmodders/amxmodx/blob/49a8b959b3a73f244327e6df6f8aedac54927058/plugins/include/amxconst.inc#L35
     *
     * @var int
     */
    const MAX_MAPNAME_LENGTH = 64;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Gets servers with a specific map.
     *
     * @return HasMany
     */
    public function servers(): HasMany
    {
        return $this->hasMany(Server::class);
    }
}
