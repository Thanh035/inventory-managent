<?php

namespace App\Services\Impl;

use App\Exceptions\UnauthorizedException;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Services\AuthenticationService;

class AuthenticationServiceImpl implements AuthenticationService
{

    /**
     * @throws UnauthorizedException
     */
    public function login(LoginRequest $request): LoginResource
    {
        $credentials = $request->only('email', 'password');
        if (!$token = auth()->attempt($credentials)) {
            throw new UnauthorizedException('Unauthorized');
        }
        return new LoginResource($token);
    }
}
