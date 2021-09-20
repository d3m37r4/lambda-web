<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @method static firstOrCreate(array $array, array $array1)
 */
class Map extends Model
{
    /**
     * The table associated with model.
     *
     * @var string
     */
    protected $table = 'maps';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Gets servers with a specific map
     *
     * @return HasMany
     */
    public function servers(): HasMany
    {
        return $this->hasMany(Server::class);
    }
}
