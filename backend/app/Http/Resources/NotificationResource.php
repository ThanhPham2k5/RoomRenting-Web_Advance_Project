<?php

namespace App\Http\Resources;

use App\Http\Resources\Account_User\AccountResource;
use App\Http\Resources\Payments\PayBillResource;
use App\Http\Resources\Payments\RechargeBillResource;
use App\Http\Resources\Posts\PostResource;
use App\Models\Payments\PayBill;
use App\Models\Payments\RechargeBill;
use App\Models\Posts\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'content' => $this->content,
            'status' => $this->status,
            'notificationType' => $this->notification_type,
            'account' => AccountResource::make(
                $this->whenLoaded('account')
            ),
            'notifiableType' => $this->notifiable_type,
            'notifiable' => $this->whenLoaded('notifiable', function() {
                if ($this->notifiable instanceof Post) 
                    return new PostResource($this->notifiable);
                
                if ($this->notifiable instanceof RechargeBill) 
                    return new RechargeBillResource($this->notifiable);
                
                if ($this->notifiable instanceof PayBill) 
                    return new PayBillResource($this->notifiable);
         
                return $this->notifiable;
            }),
            'createdAt' => $this -> created_at,
        ];
    }
}
