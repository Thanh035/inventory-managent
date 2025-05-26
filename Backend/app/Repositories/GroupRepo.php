<?php

namespace App\Repositories;

interface GroupRepo extends Repository
{
    public function findByCode($code);
}
