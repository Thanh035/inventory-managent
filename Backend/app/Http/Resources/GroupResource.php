<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $name
 * @property mixed $id
 * @property mixed $code
 * @property mixed $created_at
 *
 * @property mixed $creator
 */
class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'groupName' => $this->name,
            'groupCode' => $this->code,
            'createdDate' => optional($this->created_at)->format('d M Y h:i A'),
            'createdBy' => optional($this->creator)->name,
        ];
    }
}
