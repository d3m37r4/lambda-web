<?php

use App\Models\User;

return [
    'gender' => 'Пол',
    'list' => [
        User::GENDER_NONE => 'Не указано',
        User::GENDER_MALE => 'Мужской',
        User::GENDER_FEMALE => 'Женский',
    ]
];
