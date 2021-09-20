<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

/**
 * @property mixed role
 */
class UpdateRoleRequest extends StoreRoleRequest
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
