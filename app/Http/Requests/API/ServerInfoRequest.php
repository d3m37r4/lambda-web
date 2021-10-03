<?php

namespace App\Http\Requests\API;

class ServerInfoRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'map' => ['required', 'max:64'],
            'max_players' => ['required', 'integer', 'between:0,32'],
            'update_reasons' => ['boolean', 'nullable']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            //
        ];
    }
}
