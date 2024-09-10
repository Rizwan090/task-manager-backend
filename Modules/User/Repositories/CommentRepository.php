<?php

namespace Modules\User\Repositories;

use Modules\User\Contracts\Repositories\CommentRepositoryContract;
use Illuminate\Support\Collection;
use Modules\User\Entities\Comment;
use Modules\User\DataTransfer\Requests\CommentDTO;

class CommentRepository implements CommentRepositoryContract
{
    /**
     * Get all comments for a specific task.
     */
    public function getAllByTaskId(int $taskId): Collection
    {
        return Comment::where('task_id', $taskId)->orderBy('created_at', 'asc')->get();
    }


    /**
     * Add a new comment to a task.
     */
    public function create(CommentDTO $commentDTO): Comment
    {
        $comment = new Comment();
        $comment->parent_id = $commentDTO->getParentId();
        $comment->task_id = $commentDTO->getTaskId();
        $comment->content = $commentDTO->getContent();
        $comment->save();

        return $comment;
    }

    /**
     * Update an existing comment.
     */
    public function update(Comment $comment, CommentDTO $commentDTO): Comment
    {
        $comment->parent_id = $commentDTO->getParentId();
        $comment->content = $commentDTO->getContent();
        $comment->save();

        return $comment;
    }

    /**
     * Delete a comment.
     */
    public function delete(Comment $comment): void
    {
        $comment->delete();
    }

    /**
     * Find a comment by its ID.
     */
    public function findById(int $id): ?Comment
    {
        return Comment::find($id);
    }
}
