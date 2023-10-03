<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserAndOrganisationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_data.first_name' => 'required|string|max:255',
            'user_data.last_name' => 'required|string|max:255',
            'user_data.email' => 'required|email|unique:users,email',
            'user_data.password' => 'required|string|min:8|confirmed',
            'organisation_data.name' => 'required|string|max:255',
            'organisation_data.address' => 'nullable|string',
            'organisation_data.contact_info' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'user_data.first_name.required' => 'The first name field is required.',
            'user_data.last_name.required' => 'The last name field is required.',
            'user_data.email.required' => 'The email field is required.',
            'user_data.email.email' => 'The email must be a valid email address.',
            'user_data.email.unique' => 'The email has already been taken.',
            'user_data.password.required' => 'The password field is required.',
            'user_data.password.min' => 'The password must be at least 8 characters.',
            'user_data.password.confirmed' => 'The password confirmation does not match.',
            'organisation_data.name.required' => 'The organization name field is required.',
        ];
    }
}
