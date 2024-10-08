<?php

namespace App\Models\GameServer;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

Carbon::setToStringFormat('d.m.Y - H:i:s');

/**
 * @method static create(array $array)
 * @property string title
 * @property int time
 */
class Reason extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['server_id', 'title', 'time'/*, 'overall', 'menu', 'active'*/];

    /**
     * @var array
     */
    protected $hidden = ['server_id', /*'overall', 'active',*/'created_at', 'updated_at'];

    /**
     * Gets server associated with this reason.
     * @return BelongsTo
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(GameServer::class);
    }

    /**
     * Gets formatted time.
     *
     * @return string
     * @throws Exception
     */
    public function getTimeForHumansAttribute(): string
    {
        return $this->time ?
            CarbonInterval::minutes($this->time)
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
    public function getTimeSpecialFormatted($format): string
    {
        return CarbonInterval::minutes($this->time)
            ->cascade()
            ->format($format);
    }
}
