<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsingImage extends Model
{
    protected $fillable = [
        'id',
        'image_id',
        'relation_id',
        'type_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'relation_id');
    }

    public function usingType()
    {
        return $this->belongsTo(UsingType::class, 'type_id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class,'image_id');
    }


}
