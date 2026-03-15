<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
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
            'priceMax' => $this->price_max,
            'priceMin' => $this->price_min,
            'area' => $this->area,
            'ward' => $this->ward,
            'province' => $this->province,
            'roomType' => $this->room_type,
            'maxOccupants' => $this->max_occupants,
            'accountId' => $this->account_id,
        ];
    }
}
