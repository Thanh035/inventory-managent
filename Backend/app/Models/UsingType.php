<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsingType extends Model
{
    protected $fillable = [
        'id',
        'obj'
    ];

    public function usingImage()
    {
        return $this->hasMany(UsingImage::class, 'type_id');
    }
}
