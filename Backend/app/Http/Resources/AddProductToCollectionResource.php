<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddProductToCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'idProduct' => $this->id,
            'productName' => $this->productName,
            'sellingPrice' => $this->sellingPrice,
            'quantity' => $this->quantity
        ];
    }
}
