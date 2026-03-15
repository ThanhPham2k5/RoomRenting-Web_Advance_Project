<?php

namespace App\Http\Resources\Posts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'price' => $this->price,
            'area' => $this->area,
            'houseNumber' => $this->house_number,
            'ward' => $this->ward,
            'province' => $this->province,
            'description' => $this->description,
            'deposit' => $this->deposit,
            'status' => $this->status,
            'authorized' => $this->authorized,
            'roomType' => $this->room_type,
            'maxOccupants' => $this->max_occupants,
            'userId' => $this->user_id,
            'employeeId' => $this->employee_id,
            'deletedAt' => $this->deleted_at,
        ];
    }
}
