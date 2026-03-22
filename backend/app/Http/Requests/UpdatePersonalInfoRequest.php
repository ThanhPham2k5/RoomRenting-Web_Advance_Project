<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date_of_birth' => 'sometimes|nullable|date',

            'gender' => 'sometimes|nullable|string|in:male,female,other',

            'house_number' => 'sometimes|nullable|string|max:255',
            'ward' => 'sometimes|nullable|string|max:255',
            'province' => 'sometimes|nullable|string|max:255',

            'email' => 'sometimes|nullable|email|unique:personal_infos,email,' . $this->personal_info,

            'phone_number' => [
                'sometimes',
                'nullable',
                'string',
                'regex:/^(03|05|07|08|09)[0-9]{8}$/',
                'unique:personal_infos,phone_number,' . $this->personal_info
            ],

            'profile_url' => 'sometimes|nullable|string|max:255',

            'name' => 'sometimes|nullable|string|max:255',

            'pid' => 'sometimes|nullable|string|unique:personal_infos,pid,' . $this->personal_info,
        ];
    }
}
