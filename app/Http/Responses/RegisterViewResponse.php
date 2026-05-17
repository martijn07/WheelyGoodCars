<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RegisterViewResponse implements \Laravel\Fortify\Contracts\RegisterViewResponse
{
    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse($request): Response|JsonResponse
    {
        return response()->view('auth.register');
    }
}
