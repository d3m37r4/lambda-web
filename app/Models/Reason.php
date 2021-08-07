<?php

namespace App\Models;

use Exception;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 * @property string title
 * @property int time
 */
class Reason extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reasons';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['server_id', 'title', 'time'/*, 'overall', 'menu', 'active'*/];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $casts = [
        'server_id' => 'int',
        'title' => 'string',
//        'overall' => 'bool',
//        'menu' => 'bool',
//        'active' => 'bool',
        'time_for_humans' => 'string',
    ];

    /**
     * @var array
     */
    protected $hidden = ['server_id', /*'overall', 'active',*/ 'created_at', 'updated_at'];

    /**
     * Gets servers associated with this reason.
     * @return BelongsTo
     */
    public function server(): BelongsTo {
        return $this->belongsTo(Server::class);
    }

    /**
     * Gets formatted time.
     *
     * @return string
     * @throws Exception
     */
    public function getTimeForHumansAttribute(): string {
        $minutes = $this->time;
        return $minutes ?
            CarbonInterval::minutes($minutes)
            ->cascade()
            ->forHumans(['short' => true, 'minimumUnit' => 'minute']) : 'Бессрочно';
    }

    /**
     * Gets special formatted time.
     * See the constant $formats in Carbon/CarbonInterval.php
     *
     * @param $format
     * @return string
     * @link https://php.net/manual/en/dateinterval.format.php
     */
    public function getTimeSpecialFormatted($format): string {
        return CarbonInterval::minutes($this->time)
            ->cascade()
            ->format($format);
    }
}
