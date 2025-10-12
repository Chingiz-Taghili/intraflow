<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequisitionImageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'requisition' => new RequisitionResource($this->whenLoaded('requisition')),
            'path' => $this->path,
            'sort_order' => $this->sort_order,
            'created_at' => $this->created_at,
        ];
    }
}
