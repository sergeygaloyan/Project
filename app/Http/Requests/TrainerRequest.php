<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainerRequest extends FormRequest
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

    public function messages()
    {
        return [
            "name.required" => 'Please enter your  name!',
            "email.required" => 'Please enter your email!',
            "password.required" => 'Please enter your password!',
            "role_id.required" => 'Please enter your role!',
            "phone.required" => 'Please enter your Phone!'
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'role_id' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required'

        ];

    }
}
