<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'amount' => 'required|numeric',
            'date' => 'date',
            'description' => 'string|nullable',
            'outlet_id' => 'required|exists:outlets,id',
            'product_id' => 'required|exists:Products,id',
            'type_id' => 'required|exists:transaction_categories,id',
            'warehouse_id' => 'required|exists:Warehouses,id',
        ];
    }
}
