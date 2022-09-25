<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            "email.required" => 'Please enter your email!',
            "password.required" => 'Please enter your password!',
        ];
    }
    public function rules()
    {
        return [
            'email' => 'required|email|unique',
            'password' => 'required',
        ];
    }
}