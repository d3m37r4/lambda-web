<?php

namespace App\Exceptions;

use Response;
use Exception;
use Illuminate\Http\JsonResponse;

class GameServerApiException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return Response::json(['error' => $this->getMessage()], $this->getCode());
    }
}
