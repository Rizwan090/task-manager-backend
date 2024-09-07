<?php

namespace Modules\Core\DataTransfer\Requests;

use Modules\Core\DataTransfer\DTO;

class PermissionDTO implements DTO
{
    /**
     * @param string $name
     */
    public function __construct(
        private readonly string $name,
    ) {}

    /**
     * @param string $name
     * @return static
     */
    public static function create(string $name): self
    {
        return new self($name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}
