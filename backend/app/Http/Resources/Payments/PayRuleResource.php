<?php

namespace App\Http\Resources\Payments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PayRuleResource extends JsonResource
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
            'status' => $this->status,
            'deletedAt' => $this->deleted_at,
            'createdAt' => $this->created_at,
            'payBills' => PayBillResource::collection(
                $this->whenLoaded('payBills')
            )
        ];
    }
}
