<?php

namespace App\Http\Resources\Posts;

use App\Http\Resources\Account_User\EmployeeResource;
use App\Http\Resources\Account_User\UserResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\Payments\PayBillResource;
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
            'deletedAt' => $this->deleted_at,
            'user' => UserResource::make(
                $this->whenLoaded('user')
            ),
            'employee' => EmployeeResource::make(
                $this->whenLoaded('employee')
            ),
            'postImages' => PostImageResource::collection(
                $this->whenLoaded('postImages')
            ),
            'comments' => CommentResource::collection(
                $this->whenLoaded('comments')
            ),
            'payBills' => PayBillResource::collection(
                $this->whenLoaded('payBills')
            ),
            'favorites' => FavoriteResource::collection(
                $this->whenLoaded('favorites')
            ),
            'notifications' => NotificationResource::collection(
                $this->whenLoaded('notifications')
            )
        ];
    }
}
