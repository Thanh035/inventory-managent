<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductViewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'productName' => $this->productName,
            'categoryName' => $this->categoryName,
            'supplierName' => $this->supplierName,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'sellingPrice' => $this->sellingPrice,
            'comparePrice' => $this->comparePrice,
            'capitalPrice' => $this->capitalPrice,
            'sku' => $this->sku,
            'barcode' => $this->barcode,
            'allowOrders' => $this->allowOrders,
        ];
    }
}
