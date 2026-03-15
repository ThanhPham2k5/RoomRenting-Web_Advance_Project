<?php

namespace App\Http\Resources;

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
            'accountId' => $this->account_id,
            'notifiableType' => $this->notifiable_type,
            'notifiableId' => $this->notifiable_id,
        ];
    }
}
