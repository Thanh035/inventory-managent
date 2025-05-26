<?php

namespace App\Repositories;

interface UsingTypeRepo extends Repository
{

    public function findByObj(string $obj);
}
