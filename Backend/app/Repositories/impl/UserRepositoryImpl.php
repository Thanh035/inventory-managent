<?php

namespace App\Repositories\impl;

use App\Models\User;
use App\Repositories\UserRepo;

class UserRepositoryImpl extends EloquentRepository implements UserRepo
{

    public function getModel()
    {
        return User::class;
    }

    public function findByEmail($email)
    {
    }
}
