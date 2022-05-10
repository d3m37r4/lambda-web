<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @method static givePermissionTo(mixed $attributes = [])
 * @method static paginate(mixed $env)
 * @property string name
 */
class Role extends SpatieRole
{
    /**
     * Constants defining the names of standard roles in the system.
     *
     * @note These constants are used in the system. There may be problems when changing and deleting.
     */
    const ROLE_OWNER = 'owner';
    const ROLE_ADMIN = 'admin';
    const ROLE_MODER = 'moder';
    const ROLE_USER = 'user';

    /**
     * Checks whether the specified role is an owner role.
     *
     * @return bool
     */
    public function isOwnerRole(): bool
    {
       return $this->name === Role::ROLE_OWNER;
    }

    /**
     * Checks whether the specified role is not the owner's role.
     *
     * @return bool
     */
    public function isNotOwnerRole(): bool
    {
        return $this->name != Role::ROLE_OWNER;
    }
}
