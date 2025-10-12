<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'profile_photo' => $this->profile_photo,
            'job_title' => $this->job_title,
            'phone_number' => $this->phone_number,
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'categoryResponsibles' =>
                CategoryResponsibleResource::collection($this->whenLoaded('categoryResponsibles')),
            'requisitions' => RequisitionResource::collection($this->whenLoaded('requisitions')),
            'created_at' => $this->created_at,
        ];
    }
}
