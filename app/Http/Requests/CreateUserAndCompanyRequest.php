<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserAndCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_data.full_name' => 'required|string|max:255',
            'user_data.email' => 'required|email|unique:users,email',
            'user_data.password' => 'required|string|min:8|confirmed',
            'company_data.name' => 'required|string|max:255',
            'company_data.address' => 'nullable|string',
            'company_data.contact_info' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'user_data.full_name.required' => 'The first name field is required.',
            'user_data.email.required' => 'The email field is required.',
            'user_data.email.email' => 'The email must be a valid email address.',
            'user_data.email.unique' => 'The email has already been taken.',
            'user_data.password.required' => 'The password field is required.',
            'user_data.password.min' => 'The password must be at least 8 characters.',
            'user_data.password.confirmed' => 'The password confirmation does not match.',
            'company_data.name.required' => 'The company name field is required.',
        ];
    }
}
