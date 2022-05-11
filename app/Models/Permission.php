<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Permission\Traits\HasRoles;
/**
 * @method static create(array $attributes = [])
 */
class Permission extends SpatiePermission
{
    use HasRoles;
}
