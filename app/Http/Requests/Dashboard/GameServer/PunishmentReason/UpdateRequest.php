<?php

namespace App\Http\Requests\Dashboard\GameServer\PunishmentReason;

use Illuminate\Validation\Rule;

/**
 * @property int $id
 */
class UpdateRequest extends StoreRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'name' => ['required', 'string', 'max:255',
                Rule::unique('punishment_reasons')->ignore($this->id)
                    ->where('game_server_id', $this->game_server->id)
            ],
        ]);
    }
}
