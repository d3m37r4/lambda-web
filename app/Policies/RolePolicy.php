<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('manage_roles') || $user->hasRole(User::ROLE_OWNER);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Role $role
     * @return bool
     */
    public function view(User $user, Role $role): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('manage_roles') || $user->hasRole(User::ROLE_OWNER);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Role $role
     * @return bool
     */
    public function update(User $user, Role $role): bool
    {
        /**
         * The "Owner" role can only be changed by owner.
         */
        if ($role->isOwnerRole() && !$user->hasRole(User::ROLE_OWNER)) {
            return false;
        }

        return $user->hasPermissionTo('edit_roles') || $user->hasRole(User::ROLE_OWNER);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Role $role
     * @return bool
     */
    public function delete(User $user, Role $role): bool
    {
        /**
         * The "Owner" role cannot be deleted.
         */
        if ($role->isOwnerRole()) {
            return false;
        }

        return $user->hasPermissionTo('delete_roles') || $user->hasRole(User::ROLE_OWNER);
    }
}
