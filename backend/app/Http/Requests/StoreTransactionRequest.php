<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\TransactionTypeEnum;

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
        $type = TransactionTypeEnum::Purchase->value;

        return [
            'description' => ['required', 'string'],
            'amount' => ['required', 'decimal:2', 'min:0.01', 'max:9999999999.00'],
            'type' => ['required', 'string'],
            'check' => ['exclude_if:type,'.$type, 'required', 'max:10240']
        ];
    }
}
