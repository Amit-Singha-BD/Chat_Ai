<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest {

    public function authorize(): bool{
        return true;
    }


    public function rules(): array{
        return [
            'message' => 'required|string|min:1|max:5000',
        ];
    }

    public function messages(): array{
        return [
            'message.required' => 'Please enter a message.',
            'message.string'   => 'The message must be a valid text.',
            'message.min'      => 'The message cannot be empty.',
            'message.max'      => 'The message may not be greater than 5000 characters.',
        ];
    }
}
