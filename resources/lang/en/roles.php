<?php

use App\Models\Role;

return [
    'role' => 'Role',
    'list' => [
        Role::ROLE_OWNER => 'Owner',
        Role::ROLE_ADMIN => 'Administrator',
        Role::ROLE_MODER => 'Moderator',
        Role::ROLE_USER => 'User'
    ]
];
