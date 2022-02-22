<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\CarbonInterval;
use Request;

class StoreReasonRequest extends FormRequest
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
                /* Here it is intentionally used to get index of Server model through router.
                 * It is not possible to use the following construction: $this->server
                 * due to coincidence of Model and component name: Symfony\Component\HttpFoundation\ServerBag
                 * Situation is similar with "port" field, the rules for which are given below.
                 */
                Rule::unique('reasons')->where('server_id', Request::route('server')->id)
            ],
            'months' => ['required', 'numeric', 'min:0'],
            'days' => ['required', 'numeric', 'min:0'],
            'hours' => ['required', 'numeric', 'min:0'],
            'minutes' => ['required', 'numeric', 'min:0'],
            'time' => ['required', 'numeric', 'min:0'],
            'server_id' => ['required', 'integer'],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'server_id' => Request::route('server')->id,
            'time' => CarbonInterval::months(Request::input('months'))
                ->days(Request::input('days'))
                ->hours(Request::input('hours'))
                ->minutes(Request::input('minutes'))
                ->totalMinutes,
        ]);
    }
}
