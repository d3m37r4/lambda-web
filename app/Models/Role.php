<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @method static paginate(mixed $env)
 * @property string name
 */
class Role extends SpatieRole
{
    const ROLE_OWNER = 'owner';
    const ROLE_ADMIN = 'admin';
    const ROLE_MODER = 'moder';
    const ROLE_USER = 'user';
}
