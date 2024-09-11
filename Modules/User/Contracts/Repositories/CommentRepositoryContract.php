<?php

namespace Modules\User\Contracts\Repositories;

use Illuminate\Support\Collection;
use Modules\User\DataTransfer\Requests\CommentDTO;
use Modules\User\Entities\Comment;

interface CommentRepositoryContract
{
    /**
     * Get all comments for a specific task.
     *
     * @param int $taskId
     * @return Collection
     */
    public function getAllByTaskId(int $taskId): Collection;

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
     * @param Comment $comment
     * @param CommentDTO $commentDTO
     * @return Comment
     */
    public function update(Comment $comment, CommentDTO $commentDTO): Comment;

    /**
     * Delete a comment.
     *
     * @param Comment $comment
     * @return void
     */
    public function delete(Comment $comment): void;

    /**
     * Find a comment by its ID.
     *
     * @param int $id
     * @return Comment|null
     */
    public function findById(int $id): ?Comment;
}
