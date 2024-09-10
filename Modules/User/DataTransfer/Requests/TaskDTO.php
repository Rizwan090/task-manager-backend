<?php

namespace Modules\User\DataTransfer\Requests;

class TaskDTO
{
    private ?int $parentId;
    private int $projectId;
    private string $title;
    private ?string $description;
    private bool $isActive;
    private ?int $assigneeId;

    private function __construct(
        ?int $parentId,
        int $projectId,
        string $title,
        ?string $description,
        bool $isActive,
        ?int $assigneeId
    ) {
        $this->parentId = $parentId;
        $this->projectId = $projectId;
        $this->title = $title;
        $this->description = $description;
        $this->isActive = $isActive;
        $this->assigneeId = $assigneeId;
    }

    public static function create(?int $parentId, int $projectId, string $title, ?string $description, bool $isActive, ?int $assigneeId): self
    {
        return new self($parentId, $projectId, $title, $description, $isActive, $assigneeId);
    }


    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function getProjectId(): int
    {
        return $this->projectId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function getAssigneeId(): ?int
    {
        return $this->assigneeId;
    }
}
