<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'roleId' => 'required|numeric|not_in:1,2|exists:roles,id',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->fullName) {
            $this->merge([
                'full_name' => $this->fullName
            ]);
        }
        if ($this->roleId) {
            $this->merge([
                'role_id' => $this->roleId
            ]);
        }
    }

    public function messages()
    {
        return [
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}
