<?php

namespace App\Repositories\impl;

use App\Models\Product;
use App\Repositories\ProductRepo;

class ProductRepositoryImpl extends EloquentRepository implements ProductRepo
{

    public function getModel(): string
    {
        return Product::class;
    }
}
