<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 * @property string name
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
    ];

    /**
     * @var array
     */
    protected $hidden = ['server_id', /*'overall', 'active',*/ 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function server(): BelongsTo {
        return $this->belongsTo(Server::class);
    }
}
