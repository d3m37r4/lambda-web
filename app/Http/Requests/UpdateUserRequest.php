<?php

namespace App\Http\Requests;

use Request;
use App\Models\User;
use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * @property User user
 */
class UpdateUserRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'password' => ['exclude_if:password_confirmation,null', Password::defaults(), 'confirmed', 'same:password_confirmation'],
            'full_name' => ['nullable', 'string', 'max:255'],
            'gender' => [Rule::in(User::GENDERS)],
            'birth_date' => ['nullable', 'date'],
            'country_id' => ['nullable', Rule::in(Country::all()->pluck('id'))],
            'biography' => ['nullable', 'string']
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
            'country_id' => Request::get('country')
        ]);
    }
}
