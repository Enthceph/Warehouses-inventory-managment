<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|integer|exists:users,id',
            'full_name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $this->id,
            'password' => 'string|min:8|confirmed',
        ];
    }
}
