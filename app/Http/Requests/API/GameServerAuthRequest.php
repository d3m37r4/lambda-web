<?php

namespace App\Http\Requests\API;

use App\Models\GameServer\GameServer;

class GameServerAuthRequest extends GameServerApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'port' => ['required', 'integer', 'between:1,65535'],
            'auth_token' => ['required', 'string', 'size:'.GameServer::MAX_AUTH_TOKEN_LENGTH]
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
