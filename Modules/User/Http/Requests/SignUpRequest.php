<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\DataTransfer\Requests\SignUpDTO;

class SignUpRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'nullable|exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email.',
            'email.unique' => 'Email has already been used.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Passwords do not match.',
            'role_id.exists' => 'Role ID is invalid.',
        ];
    }

    public function getDTO(): SignUpDTO
    {
        return SignUpDTO::create(
            strval($this->input('name')),
            strval($this->input('email')),
            strval($this->input('password')),
            intval($this->input('role_id', null))
        );
    }
}
