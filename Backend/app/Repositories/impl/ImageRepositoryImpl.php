<?php

namespace App\Repositories\impl;

use App\Models\Image;
use App\Repositories\ImageRepo;

class ImageRepositoryImpl extends EloquentRepository implements ImageRepo
{
    public function getModel(): string
    {
        return Image::class;
    }
}
