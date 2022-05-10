<?php

use App\Models\Role;

return [
    'role' => 'Роль',
    'list' => [
        Role::ROLE_OWNER => 'Владелец',
        Role::ROLE_ADMIN => 'Администратор',
        Role::ROLE_MODER => 'Модератор',
        Role::ROLE_USER => 'Пользователь'
    ]
];
