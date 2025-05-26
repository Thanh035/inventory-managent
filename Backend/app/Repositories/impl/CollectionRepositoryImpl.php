<?php

namespace App\Repositories\impl;

use App\Models\Collection;
use App\Repositories\CollectionRepo;

class CollectionRepositoryImpl extends EloquentRepository implements CollectionRepo
{

    public function getModel(): string
    {
        return Collection::class;
    }

}
