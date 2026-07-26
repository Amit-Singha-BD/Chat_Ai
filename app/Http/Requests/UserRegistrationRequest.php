<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class UserRegistrationRequest extends FormRequest {

    public function authorize(): bool{
        return true;
    }


    public function rules(): array{
        return [
            "name"     => "required|string|min:3|max:100",
            "email"    => "required|string|email:rfc,dns|max:255|unique:users,email",
            "password" => "required|string|min:8|max:20|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.#^()_\-+=])[A-Za-z\d@$!%*?&.#^()_\-+=]+$/",
        ];
    }

    #[Override]
    public function messages(){
        return [
            'name.required' => 'Please enter your full name.',
            'name.string'   => 'The name must be a valid text.',
            'name.min'      => 'Your name must be at least 3 characters.',
            'name.max'      => 'Your name may not be greater than 100 characters.',

            'email.required' => 'Please enter your email address.',
            'email.string'   => 'The email must be a valid text.',
            'email.email'    => 'Please enter a valid email address.',
            'email.max'      => 'The email may not be greater than 255 characters.',
            'email.unique'   => 'This email address is already registered.',

            'password.required'  => 'Please enter your password.',
            'password.string'    => 'The password must be a valid text.',
            'password.min'       => 'Your password must be at least 8 characters.',
            'password.max'       => 'Your password may not be greater than 20 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.regex'     => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ];
    }
}
