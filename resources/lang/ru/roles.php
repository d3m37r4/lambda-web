<?php

use App\Models\Role;

return [
    'role' => 'Роль',
    'management' => 'Управление ролями',
    'edit' => 'Редактирование роли: :role',
    'delete' => 'Удалить роль',
    'confirm_delete' => "Вы действительно хотите удалить роль ':role'?",
    'list' => [
        Role::ROLE_OWNER => 'Владелец',
        Role::ROLE_ADMIN => 'Администратор',
        Role::ROLE_MODER => 'Модератор',
        Role::ROLE_USER => 'Пользователь'
    ]
];
