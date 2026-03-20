<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
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
            'price_max' => 'nullable|numeric|min:0',
            'price_min' => 'nullable|numeric|min:0',
            'area' => 'nullable|numeric|min:0',
            'ward' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'room_type' => 'nullable|in:room,apartment,dorm',
            'max_occupants' => 'nullable|integer|min:1',
        ];
    }
}
