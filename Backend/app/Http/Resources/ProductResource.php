<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'productName' => $this->productName,
            'sku' => $this->sku,
            'barcode' => $this->barcode,
            'quantity' => $this->quantity,
            'categoryName' => $this->categoryName,
            'supplierName' => $this->supplierName,
            'image' => $this->usingImage()
                    ->where('type_id', 3)
                    ->with('image') // Lấy thông tin từ bảng `images`
                    ->first()?->image?->name
        ];
    }
}
