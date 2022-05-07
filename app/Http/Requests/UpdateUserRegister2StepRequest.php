<?php

namespace App\Http\Requests;

use Request;
use App\Models\User;
use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property User user
 */
class UpdateUserRegister2StepRequest extends FormRequest
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
            'full_name' => ['nullable', 'string', 'max:255'],
            'gender' => [Rule::in(User::GENDERS)],
            'date_of_birth' => ['nullable', 'date'],
            'country_id' => ['nullable', Rule::in(Country::all()->pluck('id'))],
            'biography' => ['nullable', 'string']
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
            'country_id' => Request::get('country')
        ]);
    }
}
