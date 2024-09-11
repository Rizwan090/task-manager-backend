<?php

namespace Modules\User\DataTransfer\Requests;

use Modules\User\Enum\Status;

class TaskDTO
{
    private ?int $parentId;
    private int $projectId;
    private string $title;
    private ?string $description;
    private Status $status;
    private ?int $assigneeId;

    private function __construct(
        ?int $parentId,
        int $projectId,
        string $title,
        ?string $description,
        Status $status,
        ?int $assigneeId
    ) {
        $this->parentId = $parentId;
        $this->projectId = $projectId;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->assigneeId = $assigneeId;
    }

    public static function create(?int $parentId, int $projectId, string $title, ?string $description, Status $status, ?int $assigneeId): self
    {
        return new self($parentId, $projectId, $title, $description, $status, $assigneeId);
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

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getStatusValue(): string
    {
        return $this->status->value;
    }

    public function getAssigneeId(): ?int
    {
        return $this->assigneeId;
    }

    public function toArray(): array
    {
        return [
            'parent_id' => $this->parentId,
            'project_id' => $this->projectId,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status->value,
            'assignee_id' => $this->assigneeId,
        ];
    }
}
