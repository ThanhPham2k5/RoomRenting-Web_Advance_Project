<?php

namespace App\Http\Requests;

use App\Models\Account_User\Employee;
use App\Models\Account_User\PersonalInfo;
use App\Models\Account_User\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePersonalInfoRequest extends FormRequest
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
        $personalInfoRoute = $this->route('personalInfo');
        $id = is_object($personalInfoRoute) ? $personalInfoRoute->id : $personalInfoRoute;

        $accountRoute = $this->route('account');
        if ($accountRoute) {
            $accountId = is_object($accountRoute) ? $accountRoute->id : $accountRoute;

            $id = User::where('account_id', $accountId)->value('personal_info_id') 
               ?? Employee::where('account_id', $accountId)->value('personal_info_id');
        }

        return [
        'date_of_birth' => 'sometimes|nullable|date',
        'gender'        => 'sometimes|nullable|string|in:Nam,Nữ,Khác',
        'house_number'  => 'sometimes|nullable|string|max:255',
        'ward'          => 'sometimes|nullable|string|max:255',
        'province'      => 'sometimes|nullable|string|max:255',
        'name'          => 'sometimes|nullable|string|max:255',
        'profile_url'   => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:2048',

        'email' => [
            'sometimes',
            'email',
            Rule::unique('personal_infos', 'email')->ignore($id),
        ],

        'phone_number' => [
            'sometimes',
            'string',
            'regex:/^(03|05|07|08|09)[0-9]{8}$/',
            Rule::unique('personal_infos', 'phone_number')->ignore($id)
        ],

        'pid' => [
            'sometimes',
            'nullable',
            'string',
            'digits:12',
            Rule::unique('personal_infos', 'pid')->ignore($id),
        ],
    ];
    }
}
