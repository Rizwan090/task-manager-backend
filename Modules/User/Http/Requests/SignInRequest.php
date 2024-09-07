<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\DataTransfer\Requests\SignInDTO;

class SignInRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email field is required.',
            'email.email' => 'Please enter a valid email.',
            'email.exists' => 'The provided credentials are incorrect.',
            'password.required' => 'Password field is required.',
            'password.string' => 'Password field must be a string.',
        ];
    }

    public function getDTO(): SignInDTO
    {
        return SignInDTO::create(
            strval($this->input('email')),
            strval($this->input('password'))
        );
    }
}
