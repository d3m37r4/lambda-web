<?php

namespace App\Http\Requests\API\GameServer;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

abstract class ApiRequest extends FormRequest
{
    /**
     * Determine if the game server is authorized to make this request.
     *
     * @note Verification of game server authorization is carried out by AccessTokenMiddleware.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * If validator fails return the exception in json form.
     *
     * @param Validator $validator
     * @return array
     */
    protected function failedValidation(Validator $validator): array
    {
        throw new HttpResponseException(
            Response::json(['errors' => $validator->errors()], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
