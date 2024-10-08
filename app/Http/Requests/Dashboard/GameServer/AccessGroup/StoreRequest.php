<?php

namespace App\Http\Requests\Dashboard\GameServer\AccessGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Request;

class StoreRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255',
                /* Here it is intentionally used to get index of GameServer model through router.
                 * It is not possible to use the following construction: $this->server
                 * due to coincidence of Model and component name: Symfony\Component\HttpFoundation\ServerBag
                 * Situation is similar with "port" field, the rules for which are given below.
                 */
                Rule::unique('access_groups')->where('server_id', Request::route('server')->id)
            ],
            'flags' => ['required', 'string', 'max:255'],
            'prefix' => ['required', 'string', 'max:255'],
            'server_id' => ['required', 'integer'],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'server_id' => Request::route('server')->id
        ]);
    }
}
