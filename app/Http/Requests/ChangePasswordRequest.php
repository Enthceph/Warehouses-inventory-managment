<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'new_password' => [
                'different:old_password',
                'required',
                'min:6',
                'max:255',
            ],
            'password_confirmation' => [
                'same:new_password',
                'required',
            ],

            'old_password' => [
                'current_password:sanctum',
                'required',
            ],
        ];
    }


//    public function messages()
//    {
//        return [
//            'old_password' => [
//                'current_password' => 'The new password is the same as the previous one'
//            ],
//            'password_confirmation' => [
//                'same' => 'The new password and the confirmation password do not match'
//            ],
//            'new_password' => [
//                'different' => 'The new password is the same as the previous one',
//                'required' => 'The new password was not sent',
//                'min' => 'Password must be at least 6 characters',
//                'max' => 'Maximum password length is 255 characters'
//            ]
//        ];
//    }
}
