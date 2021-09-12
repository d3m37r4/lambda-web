<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Traits\HasPermissions;

/**
 * @method static paginate(mixed $env)
 * @property string name
 */
class Role extends SpatieRole {
    use HasPermissions;
}
