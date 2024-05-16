<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Traits\HasPermissions;

class Role extends SpatieRole
{
    use HasPermissions;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 10;

    /**
     * Checks whether the specified role is an owner role.
     *
     * @return bool
     */
    public function isOwnerRole(): bool
    {
       return $this->name === User::ROLE_OWNER;
    }
}
