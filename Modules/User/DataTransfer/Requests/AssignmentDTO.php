<?php

namespace Modules\User\DataTransfer\Requests;

use Illuminate\Http\UploadedFile;
use Modules\Core\DataTransfer\DTO;

final readonly class AssignmentDTO implements DTO
{
    public function __construct(
        private string       $title,
        private string       $description,
        private string       $url,
        private UploadedFile $file,
        private string       $deadline,
        private string       $batch_id,
    ) {}

    public static function create(
        string $title,
        string $description,
        string $url,
        UploadedFile $file,
        string $deadline,
        string $batch_id,
    ): self {
        return new self($title, $description, $url, $file, $deadline, $batch_id);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getFile(): UploadedFile
    {
        return $this->file;
    }

    public function getDeadline(): string
    {
        return $this->deadline;
    }

    public function getBatchId(): string
    {
        return $this->batch_id;
    }
}
