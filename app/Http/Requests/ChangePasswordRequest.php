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
            'old_password' => [
                'current_password:sanctum',
            ],
            'password_confirmation' => [
                'same:old_password'
            ],
            'new_password' => [
                'different:old_password',
                'required',
                'min:6',
                'max:255',
            ]
        ];
    }


    public function messages()
    {
        return [
            'old_password'=>[
                'current_password'=>'Новый пароль такой же как и предыдущий'
            ],
            'password_confirmation' => [
                'same'=>'Новый пароль и пароль для подтверждения не совпадают'
            ],
            'new_password' => [
                'different' => 'Новый пароль совпадает с предыдущим',
                'required' => 'Новый пароль не был передан',
                'min' => 'Пароль должен быть не меньше 6 символов',
                'max' => 'Максимальная длина пароля 255 символов'
            ]
        ];
    }
}
