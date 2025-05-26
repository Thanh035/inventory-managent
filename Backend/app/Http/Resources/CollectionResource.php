<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'productCount' => $this->code
//            'created_at' => $this->created_at ? $this->created_at->format('d M Y h:i A') : null,
//            'updated_at' => $this->updated_at ? $this->updated_at->format('d M Y h:i A') : null
        ];
    }
}
