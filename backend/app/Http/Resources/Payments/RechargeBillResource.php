<?php

namespace App\Http\Resources\Payments;

use App\Http\Resources\Account_User\AccountResource;
use App\Http\Resources\NotificationResource;
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
            'account' => AccountResource::make(
                $this->whenLoaded('account')
            ),
            'rechargeRule' => RechargeRuleResource::make(
                $this->whenLoaded('rechargeRule')
            ),
            'notifications' => NotificationResource::collection(
                $this->whenLoaded('notifications')
            )
        ];
    }
}
