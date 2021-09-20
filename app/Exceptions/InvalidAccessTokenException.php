<?php

namespace App\Exceptions;

use Exception;
use Response;
use Illuminate\Http\JsonResponse;

class InvalidAccessTokenException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return Response::json([
            'error' => $this->getMessage(),
        ], $this->getCode());
    }
}
