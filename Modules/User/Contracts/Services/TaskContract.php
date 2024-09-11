<?php

namespace Modules\User\Contracts\Services;

use Illuminate\Support\Collection;
use Modules\User\DataTransfer\Requests\TaskDTO;
use Modules\User\Entities\Task;
use Modules\User\Enum\Status;

interface TaskContract
{
    /**
     * Create a new task.
     *
     * @param TaskDTO $taskDTO
     * @return Task
     */
    public function create(TaskDTO $taskDTO): Task;

    /**
     * Get all tasks.
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Find a task by its ID.
     *
     * @param int $id
     * @return Task|null
     */
    public function findById(int $id): ?Task;

    /**
     * Update an existing task.
     *
     * @param Task $task
     * @param TaskDTO $taskDTO
     * @return Task
     */
    public function update(Task $task, TaskDTO $taskDTO): Task;

    /**
     * Delete a task.
     *
     * @param Task $task
     * @return bool|null
     */
    public function delete(Task $task): ?bool;

    /**
     * Assign a user to a task.
     *
     * @param Task $task
     * @param int $userId
     * @return bool
     */
    public function assignUserToTask(Task $task, int $userId): bool;

    /**
     * Get all tasks by project ID.
     *
     * @param int $projectId
     * @return Collection
     */
    public function getAllByProjectId(int $projectId): Collection;

    /**
     * Get all tasks by status.
     *
     * @param Status $status
     * @return Collection
     */
    public function getByStatus(Status $status): Collection;
}
