<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'account' => ['required', 'exists:accounts,id'],
            'amount' => ['required', 'gt:0.00'],
            'date' => ['required'],
            'note' => ['nullable'],
            'type' => ['required', 'in:C,D']
        ];
    }
}
