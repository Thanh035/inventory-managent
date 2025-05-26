<?php

namespace App\Repositories;

interface UserRepo extends Repository
{

    public function findByEmail($email);
}
