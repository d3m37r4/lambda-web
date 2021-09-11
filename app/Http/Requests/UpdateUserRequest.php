<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property mixed user
 */
class UpdateUserRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($this->user)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'password' => ['exclude_if:password_confirmation,null', 'min:6', 'confirmed', 'same:password_confirmation'],
            'role' => ['required', 'string'],
        ];
    }
}
