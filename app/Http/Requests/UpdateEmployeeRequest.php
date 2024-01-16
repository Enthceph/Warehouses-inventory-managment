<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $authUser = Auth::user();
        if ($authUser->role->name == "Admin") return true;

        if ($authUser->role->name == "Owner") {
            if ($this->input('company_id') !== $authUser['company_id']) {
                return false;
            }
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'full_name' => 'string|max:255',
            'email' => 'email|unique:users,email',
            'role_id' => 'numeric|not_in:1,2|exists:roles,id',
            'password' => 'string|min:8|confirmed',
        ];
    }

}
