<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;

interface AuthenticationService
{
    public function login(LoginRequest $request): LoginResource;
}
