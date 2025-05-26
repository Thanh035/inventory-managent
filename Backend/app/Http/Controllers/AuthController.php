<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use App\Services\AuthenticationService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected UserService $userService;
    protected AuthenticationService $authenticationService;

    public function __construct(UserService $userService, AuthenticationService $authenticationService)
    {
        $this->userService = $userService;
        $this->authenticationService = $authenticationService;
    }


    public function login(LoginRequest $request): LoginResource
    {
        return $this->authenticationService->login($request);
    }

    public function profile(): ProfileResource
    {
        return new ProfileResource(auth()->user());
    }

    public function logout(): JsonResponse
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(): LoginResource
    {
        return new LoginResource(auth()->refresh());
    }


    public function storeUser(StoreUserRequest $request): UserResource
    {
        return $this->userService->create($request->all());
    }

}
