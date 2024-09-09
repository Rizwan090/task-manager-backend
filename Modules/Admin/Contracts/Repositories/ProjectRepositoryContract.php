<?php

namespace Modules\Admin\Contracts\Repositories;

use Illuminate\Support\Collection;
use Modules\Admin\Entities\Project;

interface ProjectRepositoryContract
{
    public function create(string $name): Project;
    public function getAll(): Collection;
    public function findById(int $id): ?Project;
    public function delete(Project $project): ?bool;
    public function update(Project $project, string $name): Project;
    public function assignUsersToProject(int $projectId, array $userIds): bool;
}
