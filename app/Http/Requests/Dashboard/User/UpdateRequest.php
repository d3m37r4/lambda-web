<?php

namespace App\Http\Requests\Dashboard\User;

use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * @property User user
 */
class UpdateRequest extends UpdateUserRequest
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
            'password' => ['nullable', 'string', Password::defaults()],
            'role' => ['required', 'integer'],
            'override_permissions'  => ['boolean'],
            'permissions' => ['array'/*'nullable', 'required'*//*, 'string'*/],
        ]);
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        if(empty($this->password)) {
            $this->request->remove('password');
        }
    }
}
