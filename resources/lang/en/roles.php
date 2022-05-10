<?php

use App\Models\Role;

return [
    'role' => 'Role',
    'management' => 'Role management',
    'edit' => 'Editing a role: :role',
    'delete' => 'Delete role',
    'confirm_delete' => "Do you really want to delete role ':role'?",
    'list' => [
        Role::ROLE_OWNER => 'Owner',
        Role::ROLE_ADMIN => 'Administrator',
        Role::ROLE_MODER => 'Moderator',
        Role::ROLE_USER => 'User'
    ]
];
