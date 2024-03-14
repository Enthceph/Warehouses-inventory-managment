<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
            'id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if ($value != Auth::id()) {
                        $fail('The ' . $attribute . ' is invalid.');
                    }
                },
            ],
            'full_name' => 'string|max:255',
            'email' => 'email|unique:users,email',
            'role_id' => 'numeric|not_in:1,2|exists:roles,id',
            'password' => 'string|min:8|confirmed',
        ];
    }
}
