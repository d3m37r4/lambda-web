<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Validation\Rule;

/**
 * @property User user
 */
class AdminUpdateUserRequest extends UpdateUserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'login' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($this->user)],
            'role' => ['required', 'string'],
        ]);
    }
}
