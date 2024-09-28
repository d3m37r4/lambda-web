<?php

use App\Models\User;

return [
    'gender' => 'Gender',
    'list' => [
        User::GENDER_NONE => 'Not Specified',
        User::GENDER_MALE => 'Male',
        User::GENDER_FEMALE => 'Female',
    ]
];
