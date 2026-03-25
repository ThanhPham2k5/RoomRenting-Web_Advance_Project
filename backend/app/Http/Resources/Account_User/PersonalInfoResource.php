<?php

namespace App\Http\Resources\Account_User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PersonalInfoResource extends JsonResource
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
            'dateOfBirth' => $this->date_of_birth,
            'gender' => $this->gender,
            'houseNumber' => $this->house_number,
            'ward' => $this->ward,
            'province' => $this->province,
            'phoneNumber' => $this->phone_number,
            'profileUrl' => $this->profile_url
                ? url(Storage::url($this->profile_url))
                : null,
            'name' => $this->name,
            'pid' => $this->pid,
            'user' => UserResource::make(
                $this->whenLoaded('user')
            ),
            'employee' => EmployeeResource::make(
                $this->whenLoaded('employee')
            )
        ];
    }
}
