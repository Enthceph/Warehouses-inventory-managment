<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetWarehouseInventoryRequest extends FormRequest
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
            'id' => 'integer|required|exists:warehouses,id',
        ];
    }

    public function messages()
    {
        return [
            'id.integer' => 'The ID must be a numeric value.',
            'id.required' => 'Please provide the ID.',
            'id.exists' => 'The selected warehouse ID does not exist.',
        ];
    }
}
