<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\DataTransfer\Requests\UpdateUserDTO;

final class UserUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string|array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            "name" => "nullable|string|max:255",
            "email" => "nullable|email|max:255",
            "password" => "nullable|string|min:8",
        ];
    }

    /**
     * Get the data transfer object (DTO) for user update.
     *
     * @return UpdateUserDTO
     */
    public function getDTO(): UpdateUserDTO
    {
        return UpdateUserDTO::create([
            'name' => $this->input("name"),
            'email' => $this->input("email"),
            'password' => $this->input("password"),
        ]);
    }

}
