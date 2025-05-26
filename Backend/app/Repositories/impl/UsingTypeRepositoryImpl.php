<?php

namespace App\Repositories\impl;

use App\Models\UsingType;
use App\Repositories\UsingTypeRepo;

class UsingTypeRepositoryImpl extends EloquentRepository implements UsingTypeRepo
{
    public function getModel(): string
    {
        return UsingType::class;
    }

    public function findByObj(string $obj)
    {
        return UsingType::where('obj', $obj)->first();
    }
}
