<?php

namespace App\Http\Resources\Payments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RechargeRuleResource extends JsonResource
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
            'points' => $this->points,
            'money' =>$this->money,
            'deletedAt' => $this->deleted_at,
            'rechargeBills' => RechargeBillResource::collection(
                $this->whenLoaded('rechargeBills')
            )
        ];
    }
}
