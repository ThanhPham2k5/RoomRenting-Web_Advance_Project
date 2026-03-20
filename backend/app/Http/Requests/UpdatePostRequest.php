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
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'area' => 'required|numeric|min:0',
            'house_number' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'description' => 'required|string',
            'deposit' => 'required|numeric|min:0',
            'status' => 'required|string|in:rejected,pending,expired,completed,failed',
            'room_type' => 'required|string|in:room,apartment,dorm',
            'max_occupants' => 'required|integer|min:1',
            'user_id' => 'required|exists:users,id',
            'employee_id' => 'nullable|exists:employees,id',
            'authorized' => 'required|boolean',
            'next_payment_date' => 'nullable|date',
        ];
    }
}
