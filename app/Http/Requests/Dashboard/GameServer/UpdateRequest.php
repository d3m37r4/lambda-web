<?php

namespace App\Http\Requests\Dashboard\GameServer;

use App\Models\GameServer\GameServer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property GameServer $game_server
 */
class UpdateRequest extends FormRequest
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
                Rule::unique('game_servers')->ignore($this->game_server->id)->where(function ($query) {
                    return $query->where('port', $this->input('port'));
                })
            ],
            'port' => ['required', 'integer', 'between:1,65535',
                Rule::unique('game_servers')->ignore($this->game_server->id)->where(function ($query) {
                    return $query->where('ip', $this->input('ip'));
                })
            ],
            'rcon' => ['nullable', 'string', 'max:128'],
            'auth_token' => ['nullable', 'string', 'max:' . GameServer::MAX_AUTH_TOKEN_LENGTH],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        if(empty($this->auth_token)) {
            $this->request->remove('auth_token');
        }
    }
}
