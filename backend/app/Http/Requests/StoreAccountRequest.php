<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
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
            'username' => 'required|string|min:3|max:30|unique:accounts,username',
            'password' => 'required|string|min:8|max:255|confirmed',
            'email' => 'required|email|unique:personal_infos,email',
            'role' => 'required|string|in:user,employee',
            'phone_number' => [
                'required',
                'string',
                'regex:/^(03|05|07|08|09)[0-9]{8}$/'
            ],
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name'
        ];
    }
}
