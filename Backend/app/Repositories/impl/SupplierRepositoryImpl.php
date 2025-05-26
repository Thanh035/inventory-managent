<?php

namespace App\Repositories\impl;

use App\Models\Supplier;
use App\Repositories\SupplierRepo;

class SupplierRepositoryImpl extends EloquentRepository implements SupplierRepo
{

    public function getModel(): string
    {
        return Supplier::class;
    }
}
