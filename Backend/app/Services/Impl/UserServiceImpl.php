<?php

namespace App\Services\Impl;

use App\Exceptions\InvalidPasswordException;
use App\Exceptions\ResourceNotFoundException;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Repositories\GroupRepo;
use App\Repositories\UserRepo;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserServiceImpl implements UserService
{
    protected UserRepo $userRepo;
    protected GroupRepo $groupRepo;

    public function __construct(UserRepo $userRepo, GroupRepo $groupRepo)
    {
        $this->userRepo = $userRepo;
        $this->groupRepo = $groupRepo;
    }

    public function getAllManagedUsers()
    {
        return UserResource::collection(
            $this->userRepo->getAll()
        );
    }

    public function createUser(UserCreateRequest $userRequest): UserResource
    {
        $user = $this->userRepo->create(
            [
                'name' => $userRequest['name'],
                'email' => $userRequest['email'],
                'password' => bcrypt(Str::random(10))
            ]
        );
        return new UserResource($user);
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function destroy($id)
    {
        $user = $this->userRepo->findById($id);
        if (!$user) {
            throw new ResourceNotFoundException("User with id[{$id}] not found");
        }
        return $this->userRepo->destroy($user);
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function findById($id)
    {
        $user = $this->userRepo->findById($id);

        if (!$user) {
            throw new ResourceNotFoundException("User with id[{$id}] not found");
        }

        return $user;
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        //Get user_info from token
        $user = auth()->user();

        //Check user exist
        if ($user == null) {
            throw new ResourceNotFoundException("User not found");
        }

        // Kiểm tra mật khẩu cũ có đúng không
        if (!Hash::check($request->current_password, $user->getAuthPassword())) {
            throw new InvalidPasswordException("Invalid Password");
        }

//        $this->userRepo->update()

//        $user = User::where('id', $user->getAuthIdentifier())->update(
//            ['password' => bcrypt($request->new_password)]
//        );
        return $user;
    }

    public function registerUser(StoreUserRequest $request): UserResource
    {
        $user = $this->userRepo->create($request->all());
        return new UserResource($user);
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function updateUser(UserUpdateRequest $updateRequest, int $id): UserResource
    {
        $oldUser = $this->userRepo->findById($id);
        if (!$oldUser) {
            throw new ResourceNotFoundException("User with id[{$id}] not found");
        }
        $user = $this->userRepo->update($updateRequest->validated(), $oldUser);
        if (!empty($updateRequest['roles'])) {
            $roles = [];

            foreach ($updateRequest['roles'] as $code) {
                $role = $this->groupRepo->findByCode($code);

                if ($role) {
                    $roles[] = $role;
                }
            }

            $user->syncRoles($roles);
        }
        return new UserResource($user);
    }

    public function getUserById(int $id): UserResource
    {
        $user = $this->userRepo->findById($id);

        if (!$user) {
            throw new ResourceNotFoundException("User with id[{$id}] not found");
        }

        return new UserResource($user);
    }
}
