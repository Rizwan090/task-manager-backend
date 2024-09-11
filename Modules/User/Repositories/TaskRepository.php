<?php

namespace Modules\User\Repositories;

use Modules\User\Contracts\Repositories\TaskRepositoryContract;
use Illuminate\Support\Collection;
use Modules\User\Entities\Task;
use Modules\User\Enum\Status;

class TaskRepository implements TaskRepositoryContract
{
    /**
     * Create a new task.
     */
    public function create(array $data): Task
    {
        return Task::create($data);
    }

    /**
     * Get all tasks.
     */
    public function getAll(): Collection
    {
        return Task::all();
    }

    /**
     * Find a task by ID, including comments.
     */
    public function findById(int $id): ?Task
    {
        return Task::with('comments')->find($id);
    }

    /**
     * Delete a task.
     */
    public function delete(Task $task): bool
    {
        return $task->delete();
    }

    /**
     * Update an existing task.
     */
    public function update(Task $task, array $data): Task
    {
        $task->update($data);
        return $task;
    }

    /**
     * Find tasks by project ID.
     */
    public function findByProjectId(int $projectId): Collection
    {
        return Task::where('project_id', $projectId)->get();
    }

    /**
     * Assign a user to a task.
     */
    public function assignUserToTask(Task $task, int $userId): bool
    {
        $task->assignee_id = $userId;
        return $task->save();
    }

    /**
     * Get all tasks by project ID.
     */
    public function getAllByProjectId(int $projectId): Collection
    {
        return Task::where('project_id', $projectId)->get();
    }

    /**
     * Filter tasks by status.
     */
    public function getByStatus(Status $status): Collection
    {
        return Task::where('status', $status->value)->get();
    }
}
