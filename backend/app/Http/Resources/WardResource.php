<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['id'] ?? null,
            'wardCode' => $this['ward_code'] ?? null,
            'name' => $this['name'] ?? null,
            'provinceCode' => $this['province_code'] ?? null,
        ];
    }
}
