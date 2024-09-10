<?php

namespace Modules\User\DataTransfer\Requests;

class CommentDTO
{
    private ?int $parentId;
    private int $taskId;
    private string $content;
    private ?int $id;

    private function __construct(
        ?int $parentId,
        int $taskId,
        string $content,
        ?int $id = null
    ) {
        $this->parentId = $parentId;
        $this->taskId = $taskId;
        $this->content = $content;
        $this->id = $id;
    }

    /**
     * Static factory method to create a CommentDTO instance.
     */
    public static function create(?int $parentId, int $taskId, string $content, ?int $id = null): self
    {
        return new self($parentId, $taskId, $content, $id);
    }

    /**
     * Get the parent comment ID.
     */
    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    /**
     * Get the task ID associated with the comment.
     */
    public function getTaskId(): int
    {
        return $this->taskId;
    }

    /**
     * Get the comment content.
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Get the comment ID.
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
