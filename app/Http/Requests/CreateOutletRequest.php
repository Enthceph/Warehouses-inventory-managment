<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOutletRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'string|max:255|nullable',
            'contact_info' => 'string|max:255|nullable',
            'warehouse_name' => 'string|nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name must not exceed 255 characters.',

            'address.string' => 'The address must be a string.',
            'address.max' => 'The address must not exceed 255 characters.',

            'contact_info.string' => 'The contact information must be a string.',
            'contact_info.max' => 'The contact information must not exceed 255 characters.',

            'warehouse_name.string' => 'The warehouse name must be a string.'
        ];
    }
}
