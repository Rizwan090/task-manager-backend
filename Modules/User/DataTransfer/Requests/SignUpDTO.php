<?php

namespace Modules\User\DataTransfer\Requests;

use Modules\User\DataTransfer\DTO;

readonly class SignUpDTO implements DTO
{
    public function __construct(
        private string $name,
        private string $email,
        private string $password,
        private ?int   $roleId = null
    ) {}

    public static function create(string $name, string $email, string $password, ?int $roleId = null): self
    {
        return new self($name, $email, $password, $roleId);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoleId(): ?int
    {
        return $this->roleId;
    }
}
