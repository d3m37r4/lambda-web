<?php

namespace App\Http\Requests\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Response;

abstract class GameServerApiRequest extends FormRequest
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
            Response::json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
