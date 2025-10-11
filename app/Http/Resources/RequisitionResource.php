<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequisitionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'subcategory' => new SubcategoryResource($this->whenLoaded('subcategory')),
            'item_name' => $this->item_name,
            'notes' => $this->notes,
            'status' => $this->status,
            'parent' => new RequisitionResource($this->whenLoaded('parent')),
            'created_at' => $this->created_at,
        ];
    }
}
