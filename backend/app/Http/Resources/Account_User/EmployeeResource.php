<?php

namespace App\Http\Resources\Account_User;

use App\Http\Resources\Posts\PostResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'createdAt' => $this -> created_at,
            'account' => AccountResource::make(
                $this->whenLoaded('account')
            ),
            'personalInfo' => PersonalInfoResource::make(
                $this->whenLoaded('personalInfo')
            ),
            'posts' => PostResource::collection(
                $this->whenLoaded('posts')
            ),
        ];
    }
}
