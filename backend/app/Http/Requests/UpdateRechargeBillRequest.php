<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRechargeBillRequest extends FormRequest
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
            'money' => 'sometimes|numeric|min:0.01',
            'total_money' => 'sometimes|numeric|min:0.01',
            'status' => 'sometimes|in:completed,failed',
            'vat' => 'sometimes|numeric|min:0',
            'recharge_rule_id' => 'sometimes|exists:recharge_rules,id',
            'account_id' => 'sometimes|exists:accounts,id',
        ];
    }
}
