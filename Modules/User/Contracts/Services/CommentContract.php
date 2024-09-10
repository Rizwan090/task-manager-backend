<?php

namespace Modules\User\Contracts\Services;

use Modules\User\DataTransfer\Requests\CommentDTO;
use Modules\User\Entities\Comment;

interface CommentContract
{
    /**
     * Get all comments for a specific task.
     *
     * @param int $taskId
     * @return array
     */
    public function getAllByTaskId(int $taskId): array;

    /**
     * Create a new comment. The `parent_id` is optional for replies.
     *
     * @param CommentDTO $commentDTO
     * @return Comment
     */
    public function create(CommentDTO $commentDTO): Comment;

    /**
     * Update an existing comment.
     *
     * @param int $commentId
     * @param CommentDTO $commentDTO
     * @return Comment|null
     */
    public function update(int $commentId, CommentDTO $commentDTO): ?Comment;

    /**
     * Delete a comment.
     *
     * @param int $commentId
     * @return void
     */
    public function delete(int $commentId): void;

    /**
     * Get a comment by ID.
     *
     * @param int $commentId
     * @return Comment|null
     */
    public function findById(int $commentId): ?Comment;
}
