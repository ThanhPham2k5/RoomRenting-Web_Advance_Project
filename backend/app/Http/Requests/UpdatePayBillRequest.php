<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayBillRequest extends FormRequest
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
            'points' => 'required|integer|min:1',
            'status' => 'required|string|in:completed,failed',
            'account_id' => 'required|exists:accounts,id',
            'pay_rule_id' => 'required|exists:pay_rules,id',
            'post_id' => 'required|exists:posts,id',
        ];
    }
}
