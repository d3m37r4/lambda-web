<?php

namespace App\Http\Requests\API\GameServer;

use App\Models\GameServer\GameServer;

class AuthRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'Server-Ip' => ['required', 'ip'],
            'Server-Port' => ['required', 'integer', 'between:1,65535'],
            'Server-Auth-token' => ['required', 'string', 'size:'.GameServer::MAX_AUTH_TOKEN_LENGTH],
            'User-Agent' => ['required', 'in:Lambda'],
        ];
    }

    /**
     * Get the validation data from the request headers.
     *
     * @return array
     */
    public function validationData(): array
    {
        return array_merge($this->all(), [
            'Server-Ip' => $this->header('Server-Ip'),
            'Server-Port' => $this->header('Server-Port'),
            'Server-Auth-token' => $this->header('Server-Auth-token'),
            'User-Agent' => $this->header('User-Agent'),
        ]);
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
