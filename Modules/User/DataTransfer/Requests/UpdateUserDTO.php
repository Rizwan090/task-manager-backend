<?php

namespace Modules\User\DataTransfer\Requests;

use Modules\Core\DataTransfer\DTO;

final class UpdateUserDTO implements DTO
{
    /**
     * @param string|null $name
     * @param string|null $email
     * @param string|null $password
     */
    public function __construct(
        private ?string $name,
        private ?string $email,
        private ?string $password,
    )
    {
    }
    /**
     * Create a new instance of UpdateUserDTO.
     *
     * @param array $data
     * @return static
     */
    public static function create(array $data): self
    {
        return new self(
            $data['name'] ?? null,
            $data['email'] ?? null,
            $data['password'] ?? null
        );
    }

    /**
     * @return string|null
     */
    public function getName(): string|null
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getEmail(): string|null
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): string|null
    {
        return $this->password;
    }

}
