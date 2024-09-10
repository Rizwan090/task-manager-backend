<?php

namespace Modules\User\Services;

use Illuminate\Support\Collection; // Import Collection
use Modules\User\Contracts\Repositories\CommentRepositoryContract;
use Modules\User\Contracts\Services\CommentContract;
use Modules\User\DataTransfer\Requests\CommentDTO;
use Modules\User\Entities\Comment;

class CommentService implements CommentContract
{
    protected CommentRepositoryContract $commentRepository;

    public function __construct(CommentRepositoryContract $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Get all comments for a specific task.
     */
    public function getAllByTaskId(int $taskId): Collection
    {
        return $this->commentRepository->getAllByTaskId($taskId);
    }

    /**
     * Add a comment to a task.
     * If parent_id is passed, it will be treated as a reply to an existing comment.
     */
    public function create(CommentDTO $commentDTO): Comment
    {
        return $this->commentRepository->create($commentDTO);
    }

    /**
     * Update an existing comment.
     */
    public function update(int $commentId, CommentDTO $commentDTO): ?Comment
    {
        $comment = $this->commentRepository->findById($commentId);

        if (is_null($comment)) {
            throw new \Exception('Comment not found.');
        }

        return $this->commentRepository->update($comment, $commentDTO);
    }


    /**
     * Delete a comment.
     */
    public function delete(int $commentId): void
    {
        $comment = $this->commentRepository->findById($commentId);

        if (is_null($comment)) {
            throw new \Exception('Comment not found.');
        }

        $this->commentRepository->delete($comment);
    }

    /**
     * Get a comment by ID.
     */
    public function findById(int $commentId): ?Comment
    {
        return $this->commentRepository->findById($commentId);
    }
}
