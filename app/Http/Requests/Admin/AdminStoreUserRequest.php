<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\StoreUserRequest;

class AdminStoreUserRequest extends StoreUserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'role' => ['required', 'string']
        ]);
    }
}
