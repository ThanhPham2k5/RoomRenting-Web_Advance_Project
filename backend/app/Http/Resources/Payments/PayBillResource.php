<?php

namespace App\Http\Resources\Payments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PayBillResource extends JsonResource
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
            'accountId' => $this->account_id,
            'postId' => $this->post_id,
            'payRuleId' => $this->pay_rule_id,
        ];
    }
}
