<?php

namespace App\Models\GameServer;

use Closure;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 * @method map(Closure $param)
 * @method sortBy(Closure $param)
 * @property int $id
 * @property string $name
 */
class PunishmentReason extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_server_id',
        'name',
        'time'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'game_server_id',
        'created_at',
        'updated_at'
    ];

    /**
     * @var array
     */
    protected $appends = [
        'time_for_humans',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'time_for_humans' => 'string',
    ];

    /**
     * Gets formatted time.
     *
     * @return Attribute
     */
    protected function timeForHumans(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->time ?
                CarbonInterval::minutes($this->time)
                    ->cascade()
                    ->forHumans(['short' => true, 'minimumUnit' => 'minute'])
                : 'Permanently'
        );
    }

    /**
     * Gets server associated with this punishment reason.
     * @return BelongsTo
     */
    public function gameServer(): BelongsTo
    {
        return $this->belongsTo(GameServer::class);
    }

    /**
     * Gets special formatted time.
     * See the constant $formats in Carbon/CarbonInterval.php (line 203-210).
     *
     * @param string $format
     * @return string
     * @see CarbonInterval
     * @link https://php.net/manual/en/dateinterval.format.php
     */
    public function formatTime(string $format): string
    {
        return CarbonInterval::minutes($this->time)->cascade()->format($format);
    }
}
