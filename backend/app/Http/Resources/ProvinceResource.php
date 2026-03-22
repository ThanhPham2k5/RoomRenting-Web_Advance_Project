<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
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
            'provinceCode' => $this['province_code'] ?? null,
            'name' => $this['name'] ?? null,
            'shortName' => $this['short_name'] ?? null,
            'code' => $this['code'] ?? null,    
        ];
    }
}
