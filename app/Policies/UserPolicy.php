<?php

namespace App\Policies;

use Request;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function view(User $user, User $model): bool
    {
        /**
         * Method 'show' can only be viewed by an authorized user.
         * To view a specific user's profile from control panel, user must have permissions.
         * Access is determined by middlewares 'auth' and 'can:manage_users'.
         * See:
         * routes/dashboard.php
         * routes/web.php
         */
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        /**
         * To perform actions from control panel.
         */
        if (Request::routeIs('dashboard.users.*')) {
            if ($user->hasRole(User::ROLE_OWNER) || $user->hasPermissionTo('manage_users')) {
                return true;
            }
        }

        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function delete(User $user, User $model): bool
    {
        /**
         * User cannot delete himself.
         *
         * @note Only for method that is called from control panel.
         *
         */
        return $user->id != $model->id;
    }
}
