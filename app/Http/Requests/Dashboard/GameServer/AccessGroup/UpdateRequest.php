<?php

namespace App\Http\Requests\Dashboard\GameServer\AccessGroup;

use Illuminate\Validation\Rule;
use Request;

/**
 * @property mixed access_group
 */
class UpdateRequest extends StoreRequest
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
                Rule::unique('access_groups')->ignore($this->access_group)
                    ->where('server_id', Request::route('server')->id)
            ],
        ]);
    }
}
