<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UsingImage;

class Product extends Model
{
    protected $fillable = [
        'id',
        'productName',
        'categoryName',
        'supplierName',
        'description',
        'quantity',
        'sellingPrice',
        'comparePrice',
        'capitalPrice',
        'sku',
        'barcode',
        'allowOrders',
    ];
    public function usingImage()
    {
        return $this->hasMany(UsingImage::class,'relation_id');
    }


}
