<?php

namespace App\Http\Requests;

use Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**

 */
class UpdateServerRequest extends FormRequest {
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
            'name' => ['required', 'string', 'max:255'],
            'ip' => ['required', 'ip',
                /* Here it is intentionally used to get index of Server model through router.
                 * It is not possible to use the following construction: $this->server
                 * due to coincidence of Model and component name: Symfony\Component\HttpFoundation\ServerBag
                 * Situation is similar with "port" field, the rules for which are given below.
                 */
                Rule::unique('servers')->ignore(Request::route('server')->id)->where(function ($query) {
                    return $query->where('port', $this->input('port'));
                })
            ],
            'port' => ['required', 'integer', 'between:1,65535',
                /*
                 * See comment above.
                 */
                Rule::unique('servers')->ignore(Request::route('server')->id)->where(function ($query) {
                    return $query->where('ip', $this->input('ip'));
                })
            ],
            'rcon' => ['nullable', 'string', 'max:128'],
            'auth_token' => ['nullable', 'string', 'max:64'],
        ];
    }
}
