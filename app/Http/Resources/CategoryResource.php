<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'subcategories' => SubcategoryResource::collection($this->whenLoaded('subcategories')),
            'category_responsibles' =>
                CategoryResponsibleResource::collection($this->whenLoaded('categoryResponsibles')),
            'created_at' => $this->created_at,
        ];
    }
}
