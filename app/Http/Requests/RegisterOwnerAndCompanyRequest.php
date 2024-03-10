<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterOwnerAndCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user.full_name' => 'required|string|max:255',
            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required|string|min:8|confirmed',
            'company.name' => 'required|string|max:255',
            'company.address' => 'nullable|string',
            'company.contact_info' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'user.full_name.required' => 'The first name field is required.',
            'user.email.required' => 'The email field is required.',
            'user.email.email' => 'The email must be a valid email address.',
            'user.email.unique' => 'The email has already been taken.',
            'user.password.required' => 'The password field is required.',
            'user.password.min' => 'The password must be at least 8 characters.',
            'user.password.confirmed' => 'The password confirmation does not match.',
            'company.name.required' => 'The company name field is required.',
        ];
    }
}
