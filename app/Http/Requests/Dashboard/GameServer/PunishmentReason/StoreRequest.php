<?php

namespace App\Http\Requests\Dashboard\GameServer\PunishmentReason;

use Carbon\CarbonInterval;
use App\Models\GameServer\GameServer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property GameServer $game_server
 */
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
            'name' => ['required', 'string', 'max:255',
                Rule::unique('punishment_reasons')->where('game_server_id', $this->game_server->id)
            ],
            'months' => ['required', 'numeric', 'min:0'],
            'days' => ['required', 'numeric', 'min:0'],
            'hours' => ['required', 'numeric', 'min:0'],
            'minutes' => ['required', 'numeric', 'min:0'],
            'time' => ['required', 'numeric', 'min:0'],
            'game_server_id' => ['required', 'integer'],
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
            'game_server_id' => $this->game_server->id,
            'time' => CarbonInterval::months($this->input('months'))
                ->days($this->input('days'))
                ->hours($this->input('hours'))
                ->minutes($this->input('minutes'))
                ->totalMinutes
        ]);
    }
}
