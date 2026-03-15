<?php

namespace App\Http\Resources\Payments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RechargeBillResource extends JsonResource
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
            'money' => $this->money,
            'totalMoney' => $this->total_money,
            'vat' => $this->vat,
            'status' => $this->status,
            'accountId' => $this->account_id,
            'rechargeRuleId' => $this->recharge_rule_id,
        ];
    }
}
