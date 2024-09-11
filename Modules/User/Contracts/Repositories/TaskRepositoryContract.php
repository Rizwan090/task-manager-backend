<?php

namespace Modules\User\Contracts\Repositories;

use Illuminate\Support\Collection;
use Modules\User\Entities\Task;
use Modules\User\Enum\Status;

interface TaskRepositoryContract
{
    /**
     * Create a new task.
     *
     * @param array $data
     * @return Task
     */
    public function create(array $data): Task;

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
     * Update a task.
     *
     * @param Task $task
     * @param array $data
     * @return Task
     */
    public function update(Task $task, array $data): Task;

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
     * Filter tasks by status.
     *
     * @param Status $status
     * @return Collection
     */
    public function getByStatus(Status $status): Collection;
}
