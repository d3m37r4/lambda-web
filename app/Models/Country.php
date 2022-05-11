<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @method static find(int $int)
 */
class Country extends Model
{
    protected $fillable = [
        'default_name',
        'short_code'
    ];

    /**
     * Gets users associated with this country.
     *
     * @return Collection
     */
    public function users(): Collection
    {
        return User::where('country_id', $this->id)->get();
    }
}
