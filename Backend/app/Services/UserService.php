<?php

namespace App\Services;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;

interface UserService
{
    public function getAllManagedUsers();

    public function getUserById(int $id): UserResource;

    public function createUser(UserCreateRequest $userRequest): UserResource;

    public function destroy($id);

    public function changePassword(ChangePasswordRequest $request);

    public function registerUser(StoreUserRequest $request);

    public function updateUser(UserUpdateRequest $updateRequest, int $id);
}
