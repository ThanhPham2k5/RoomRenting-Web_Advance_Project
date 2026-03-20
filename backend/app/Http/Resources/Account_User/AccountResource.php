<?php

namespace App\Http\Resources\Account_User;

use App\Http\Resources\FormResource;
use App\Http\Resources\Payments\PayBillResource;
use App\Http\Resources\Payments\RechargeBillResource;
use App\Http\Resources\Posts\CommentResource;
use App\Http\Resources\Posts\FavoriteResource;
use App\Http\Resources\Posts\PostResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
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
            'role' => $this->role,
            'username' => $this->username,
            'deletedAt' => $this->deleted_at,
            'form' => FormResource::make(
                $this->whenLoaded('form')
            ),
            'user' => UserResource::make(
                $this->whenLoaded('user')
            ),
            'employee' => EmployeeResource::make(
                $this->whenLoaded('employee')
            ),
            'posts' => PostResource::collection(
                $this->whenLoaded('posts')
            ),
            'comments' => CommentResource::collection(
                $this->whenLoaded('comments')
            ),
            'favorites' => FavoriteResource::collection(
                $this->whenLoaded('favorites')
            ),
            'payBills' => PayBillResource::collection(
                $this->whenLoaded('payBills')
            ),
            'rechargeBills' => RechargeBillResource::collection(
                $this->whenLoaded('rechargeBills')
            ),
            'roles' => $this->whenLoaded('roles', function () {
                return $this->roles->pluck('name');
            }),
        ];
    }
}
