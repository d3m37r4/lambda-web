<?php

namespace App\Http\Requests\Dashboard\Role;

use Illuminate\Validation\Rule;

/**
 * @property mixed role
 */
class UpdateRequest extends StoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($this->role)],
        ]);
    }
}
