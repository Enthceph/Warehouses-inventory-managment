<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|min:2',
            'additional_info' => 'string|nullable',
            'category_id' => 'exists:product_categories,id',
        ];
    }
}
