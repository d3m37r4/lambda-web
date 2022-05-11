<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'ip' => ['required', 'ip',
                Rule::unique('servers')->where(function ($query) {
                    return $query->where('port', $this->input('port'));
                })
            ],
            'port' => ['required', 'integer', 'between:1,65535',
                Rule::unique('servers')->where(function ($query) {
                    return $query->where('ip', $this->input('ip'));
                })
            ],
            'rcon' => ['nullable', 'string', 'max:128'],
            'auth_token' => ['nullable', 'string', 'max:64'],
        ];
    }
}
