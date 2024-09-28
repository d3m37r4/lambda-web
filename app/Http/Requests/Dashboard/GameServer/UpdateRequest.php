<?php

namespace App\Http\Requests\Dashboard\GameServer;

use App\Models\GameServer\GameServer;
use Illuminate\Validation\Rule;

/**
 * @property GameServer $game_server
 */
class UpdateRequest extends StoreRequest
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
        return array_merge(parent::rules(), [
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
        ]);
    }
}
