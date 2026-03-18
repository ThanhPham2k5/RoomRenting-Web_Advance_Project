<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRechargeBillRequest extends FormRequest
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
            'money' => 'required|numeric|min:0.01',
            'total_money' => 'required|numeric|min:0.01',
            'status' => 'required|in:completed,failed',
            'vat' => 'required|numeric|min:0',
            'recharge_rule_id' => 'required|exists:recharge_rules,id',
            'account_id' => 'required|exists:accounts,id',
        ];
    }
}
