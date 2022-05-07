<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\UpdateUserRequest;
//use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property mixed user
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
            'name' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($this->user)],
            'role' => ['required', 'string'],
        ]);


//        return [
//            'name' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($this->user)],
//            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
//            'password' => ['exclude_if:password_confirmation,null', 'min:6', 'confirmed', 'same:password_confirmation'],
//            'role' => ['required', 'string'],
//        ];
    }
}
