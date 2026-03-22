<?php

namespace App\Http\Resources\Posts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostImageResource extends JsonResource
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
            'imagePostUrl' => Storage::url($this->image_post_url),
            'order' => $this->order,
            'post' => PostResource::make(
                $this->whenLoaded('post')
            ),
        ];
    }
}
