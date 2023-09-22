<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
    public function rules(){
        return [
            'first_name' => [
                'required',
                'min:2',
                'max:255'
            ],
            'last_name' => [
                'required',
                'min:2',
                'max:255'
            ],
            'email' => [
                'required',
                'unique:users',
                'email'
            ],
            'password' => [
                'required',
                'min:6',
                'max:16',
                'confirmed'
            ],
        ];
    }

    public function messages()
    {

        return [
            'email.unique' => 'Пользователь с таким Email адресом уже существует',
            'email.required' => 'Поле Email должно быть заполнено',
            'name.required' => 'Поле имя должно быть заполнено',
            'password.required' => 'Поле пароль должно быть заполнено',
        ];
    }
}
