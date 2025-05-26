<?php

namespace App\Repositories\impl;

use App\Models\Category;
use App\Repositories\CategoryRepo;

class CategoryRepositoryImpl extends EloquentRepository implements CategoryRepo
{

    public function getModel(): string
    {
        return Category::class;
    }
}
