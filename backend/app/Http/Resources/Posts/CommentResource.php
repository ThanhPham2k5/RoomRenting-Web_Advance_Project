<?php

namespace App\Http\Resources\Posts;

use App\Http\Resources\Account_User\AccountResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'content' => $this->content,
            'createdAt' => $this -> created_at,
            'account' => AccountResource::make(
                $this->whenLoaded('account')
            ),
            'post' => PostResource::make(
                $this->whenLoaded('post')
            ),
            
        ];
    }
}
