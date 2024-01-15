<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateWarehouseRequest extends FormRequest
{
    public mixed $name;

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
            'name' => 'required|string|max:255',
            'location' => 'string|max:255|nullable',
            'contact_info' => 'string|max:255|nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name field may not be greater than 255 characters.',
            'location.max' => 'The address field may not be greater than 255 characters.',
            'contact_info.max' => 'The contact info field may not be greater than 255 characters.',
        ];
    }
}
