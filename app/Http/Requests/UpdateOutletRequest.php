<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOutletRequest extends FormRequest
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
            'name' => 'string|max:255',
            'address' => 'string|max:255|nullable',
            'contactInfo' => 'string|max:255|nullable',
            'warehouseId' => 'integer'
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->contactInfo) {
            $this->merge([
                'contact_info' => $this->contactInfo
            ]);
        }
        if ($this->warehouseId) {
            $this->merge([
                'warehouse_id' => $this->warehouseId
            ]);
        }
    }

    public function messages()
    {
        return [
            'name.max' => 'The name field may not be greater than 255 characters.',
            'address.max' => 'The address field may not be greater than 255 characters.',
            'contact_info.max' => 'The contact info field may not be greater than 255 characters.',
        ];
    }
}
