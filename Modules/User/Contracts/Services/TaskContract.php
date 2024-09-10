<?php

namespace Modules\User\Contracts\Services;

use Illuminate\Support\Collection;
use Modules\User\DataTransfer\Requests\TaskDTO;
use Modules\User\Entities\Task;

interface TaskContract
{
    public function create(TaskDTO $taskDTO): Task;
    public function getAll(): Collection;
    public function findById(int $id): ?Task;
    public function update(Task $task, TaskDTO $taskDTO): Task;
    public function delete(Task $task): ?Task;
    public function assignUserToTask(Task $task, int $userId): bool;

    public function getAllByProjectId(int $projectId);

}
