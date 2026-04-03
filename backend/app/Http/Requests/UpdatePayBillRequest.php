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
            'points' => 'sometimes|integer|min:1',
            'status' => 'sometimes|string|in:completed,failed',
            'account_id' => 'sometimes|exists:accounts,id',
            'pay_rule_id' => 'sometimes|exists:pay_rules,id',
            'post_id' => 'sometimes|exists:posts,id',
        ];
    }
}
