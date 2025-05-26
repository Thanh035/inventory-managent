<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'id',
        'name',
        'url'
    ];

    public function usingImage()
    {
        return $this->hasOne(UsingImage::class, 'image_id', 'id');
    }
}
