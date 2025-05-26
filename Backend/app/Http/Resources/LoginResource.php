<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id_token' => $this->resource,  // Đây là token
        ];
    }
}
