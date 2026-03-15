<?php

namespace App\Http\Resources\Account_User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'accountId' => $this->account_id,
            'personalInfoId' => $this->personal_info_id,
        ];
    }
}
