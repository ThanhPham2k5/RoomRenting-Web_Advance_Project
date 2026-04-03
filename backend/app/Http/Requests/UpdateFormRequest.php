<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'price_max' => 'sometimes|nullable|numeric|min:0',
            'price_min' => 'sometimes|nullable|numeric|min:0',
            'area' => 'sometimes|nullable|numeric|min:0',
            'ward' => 'sometimes|nullable|string|max:255',
            'province' => 'sometimes|nullable|string|max:255',
            'room_type' => 'sometimes|nullable|in:room,apartment,dorm',
            'max_occupants' => 'sometimes|nullable|integer|min:1',
        ];
    }
}
