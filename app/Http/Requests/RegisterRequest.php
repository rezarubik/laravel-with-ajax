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
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|same:confirm',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Please fill the firstname',
            'lastname.required' => 'Please fill the lastname',
            'email.unique' => 'Email already exists',
            'password.required' => "Please fill the password",
        ];
    }
}
