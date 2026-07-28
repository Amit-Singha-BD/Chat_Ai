<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest {

    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'email'    => 'required|string|email:rfc,dns|max:255',
            'password' => 'required|string|min:8|max:20',

            'remember' => 'nullable|boolean',
        ];
    }

    public function messages(): array{
        return [
            'email.required'    => 'Please enter your email address.',
            'email.string'      => 'The email must be a valid text.',
            'email.email'       => 'Please enter a valid email address.',
            'email.max'         => 'The email may not be greater than 255 characters.',

            'password.required' => 'Please enter your password.',
            'password.string'   => 'The password must be a valid text.',
            'password.min'      => 'The password must be at least 8 characters.',
            'password.max'      => 'The password may not be greater than 20 characters.',

            'remember.boolean'  => 'The remember me option is invalid.',
        ];
    }
}
