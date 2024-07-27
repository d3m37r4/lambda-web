<?php

namespace App\Http\Requests\Dashboard\User;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;

class StoreRequest extends StoreUserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'role' => ['required', 'integer'],
            'permissions' => ['array'],
            'permissions.*' => ['integer'],
            'gender' => ['required', 'integer', 'in:' . implode(',', array_column(User::GENDERS, 'id'))],
            'name' => ['nullable', 'string', 'min:2', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
        ]);
    }
}
