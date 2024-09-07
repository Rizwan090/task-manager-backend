<?php

namespace Modules\User\DataTransfer\Requests;

use Modules\User\DataTransfer\DTO;

class SignInDTO implements DTO
{
    public function __construct(
        private readonly string $email,
        private readonly string $password
    ) {}

    public static function create(string $email, string $password): self
    {
        return new self($email, $password);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
