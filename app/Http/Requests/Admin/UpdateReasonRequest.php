<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Request;

/**
 * @property mixed reason
 */
class UpdateReasonRequest extends StoreReasonRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'title' => ['required', 'string', 'max:255',
                /* Here it is intentionally used to get index of GameServer model through router.
                 * It is not possible to use the following construction: $this->server
                 * due to coincidence of Model and component name: Symfony\Component\HttpFoundation\ServerBag
                 * Situation is similar with "port" field, the rules for which are given below.
                 */
                Rule::unique('reasons')->ignore($this->reason)
                    ->where('server_id', Request::route('server')->id)
            ],
        ]);
    }
}
