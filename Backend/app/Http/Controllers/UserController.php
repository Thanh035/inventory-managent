<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->getAllManagedUsers();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $userRequest): UserResource
    {
        return $this->userService->createUser($userRequest);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): UserResource
    {
        return $this->userService->getUserById($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $updateRequest, int $id): UserResource
    {
        return $this->userService->updateUser($updateRequest, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        //
    }
}
