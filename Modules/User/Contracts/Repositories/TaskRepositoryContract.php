<?php

namespace Modules\User\Contracts\Repositories;

use Illuminate\Support\Collection;
use Modules\User\Entities\Task;

interface TaskRepositoryContract
{
    public function create(array $data): Task;
    public function getAll(): Collection;
    public function findById(int $id): ?Task;
    public function update(Task $task, array $data): Task;
    public function delete(Task $task): ?bool;
    public function assignUserToTask(Task $task, int $userId): bool;
}
