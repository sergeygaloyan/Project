<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
    public function messages()
    {
        return [
            "name.required" => 'Please enter your name!',
            "email.required" => 'Please enter your email!',
            "password.required" => 'Please enter your password!',
//            "role_id.required" => 'Please enter your Role!',
            "phone.required" => 'Please enter your Phone!',
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
//            'role_id' => 'required',
            'password' => 'required',
            'phone' => 'required',
        ];
    }
}
