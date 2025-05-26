<?php

namespace App\Repositories\impl;

use App\Models\Group;
use App\Repositories\GroupRepo;

class GroupRepositoryImpl extends EloquentRepository implements GroupRepo
{
    public function getModel(): string
    {
        return Group::class;
    }

    public function findByCode($code): ?Group
    {
        return Group::where('code', $code)->first();
    }

}
