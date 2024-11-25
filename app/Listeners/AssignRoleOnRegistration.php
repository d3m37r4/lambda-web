<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Registered;

class AssignRoleOnRegistration
{
    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event): void
    {
        $user = $event->user;
        $role = $user->id == 1 ? User::ROLE_OWNER : User::DEFAULT_USER_ROLE;
        $user->assignRole($role);
    }
}
