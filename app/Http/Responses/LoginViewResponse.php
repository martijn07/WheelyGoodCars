<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LoginViewResponse implements \Laravel\Fortify\Contracts\LoginViewResponse
{
    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse($request): Response|JsonResponse
    {
        return response()->view('auth.login');
    }
}
