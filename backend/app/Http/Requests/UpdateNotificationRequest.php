<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationRequest extends FormRequest
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
            'content' => 'sometimes|string',
            'status' => 'required|in:unread,read',
            'notification_type' => 'sometimes|string|in:news,transaction',
            'account_id' => 'sometimes|exists:accounts,id',
            'notifiable_type' => 'nullable|string',
            'notifiable_id' => 'nullable|integer',
        ];
    }
}
