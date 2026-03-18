<?php

namespace App\Http\Resources\Payments;

use App\Http\Resources\Account_User\AccountResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\Posts\PostResource;
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
            'account' => AccountResource::make(
                $this->whenLoaded('account')
            ),
            'post' => PostResource::make(
                $this->whenLoaded('post')
            ),
            'payRule' => PayRuleResource::make(
                $this->whenLoaded('payRule')
            ),
            'notifications' => NotificationResource::collection(
                $this->whenLoaded('notifications')
            )
        ];
    }
}
