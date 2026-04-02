<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'area' => 'sometimes|numeric|min:0',
            'house_number' => 'sometimes|string|max:255',
            'ward' => 'sometimes|string|max:255',
            'province' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'deposit' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|string|in:rejected,expired,completed,failed',
            'room_type' => 'sometimes|string|in:room,apartment,dorm',
            'max_occupants' => 'sometimes|integer|min:1',
            'user_id' => 'sometimes|exists:users,id',
            'employee_id' => 'nullable|exists:employees,id',
            'authorized' => 'sometimes|boolean',
            'next_payment_date' => 'nullable|date',
            'images' => 'sometimes|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'orders' => 'required_with:images|array', // Bắt buộc phải có orders nếu có images
            'orders.*' => 'integer|min:1',
            'deleted_orders' => 'sometimes|array', // Mảng chứa các order cần xóa
            'deleted_orders.*' => 'integer|min:1',
        ];
    }
}
