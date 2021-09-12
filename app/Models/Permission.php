<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Permission\Traits\HasRoles;

class Permission extends SpatiePermission {
    use HasRoles;
}
