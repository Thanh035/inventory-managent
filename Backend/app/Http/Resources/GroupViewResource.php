<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupViewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'groupName' => $this->name,
            'groupCode' => $this->code,
            'note' => $this->note,
            'permissions' => $this->permissions->pluck('name')
        ];
    }
}
