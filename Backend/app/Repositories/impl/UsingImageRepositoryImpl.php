<?php

namespace App\Repositories\impl;

use App\Models\UsingImage;
use App\Repositories\UsingImageRepo;

class UsingImageRepositoryImpl extends EloquentRepository implements UsingImageRepo
{

    public function getModel(): string
    {
        return UsingImage::class;
    }
}
