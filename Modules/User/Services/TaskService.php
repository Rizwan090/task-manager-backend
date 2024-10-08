<?php

namespace Modules\User\Services;

use Modules\User\Contracts\Services\TaskContract;
use Modules\User\Contracts\Repositories\TaskRepositoryContract;
use Modules\User\DataTransfer\Requests\TaskDTO;
use Modules\User\Entities\Task;
use Modules\User\Enum\Status;
use Illuminate\Support\Collection;

class TaskService implements TaskContract
{
    private TaskRepositoryContract $taskRepository;

    public function __construct(TaskRepositoryContract $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Create a new task.
     */
    public function create(TaskDTO $taskDTO): Task
    {
        $data = [
            'parent_id' => $taskDTO->getParentId(),
            'project_id' => $taskDTO->getProjectId(),
            'title' => $taskDTO->getTitle(),
            'description' => $taskDTO->getDescription(),
            'status' => $taskDTO->getStatusValue(),
            'assignee_id' => $taskDTO->getAssigneeId(),
        ];

        return $this->taskRepository->create($data);
    }

    /**
     * Get all tasks.
     */
    public function getAll(): Collection
    {
        return $this->taskRepository->getAll();
    }

    /**
     * Find a task by ID.
     */
    public function findById(int $id): ?Task
    {
        return $this->taskRepository->findById($id);
    }

    /**
     * Delete a task.
     */
    public function delete(Task $task): ?bool
    {
        return $this->taskRepository->delete($task);
    }




    /**
     * Update an existing task.
     */
    public function update(Task $task, TaskDTO $taskDTO): Task
    {
        $data = [
            'parent_id' => $taskDTO->getParentId(),
            'project_id' => $taskDTO->getProjectId(),
            'title' => $taskDTO->getTitle(),
            'description' => $taskDTO->getDescription(),
            'status' => $taskDTO->getStatusValue(),
            'assignee_id' => $taskDTO->getAssigneeId(),
        ];

        return $this->taskRepository->update($task, $data);
    }

    /**
     * Find tasks by project ID.
     */
    public function findByProjectId(int $projectId): Collection
    {
        return $this->taskRepository->findByProjectId($projectId);
    }

    /**
     * Assign a user to a task.
     */
    public function assignUserToTask(Task $task, int $userId): bool
    {
        return $this->taskRepository->assignUserToTask($task, $userId);
    }

    /**
     * Get all tasks by project ID.
     */
    public function getAllByProjectId(int $projectId): Collection
    {
        return $this->taskRepository->getAllByProjectId($projectId);
    }

    /**
     * Get all tasks by status.
     */
    public function getByStatus(Status $status): Collection
    {
        return $this->taskRepository->getByStatus($status);
    }
}
