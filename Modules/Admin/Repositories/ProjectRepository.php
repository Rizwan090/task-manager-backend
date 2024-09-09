<?php

namespace Modules\Admin\Repositories;

use Illuminate\Support\Collection;
use Modules\Admin\Contracts\Repositories\ProjectRepositoryContract;
use Modules\Admin\Entities\Project;
use Modules\User\Entities\User;

readonly class ProjectRepository implements ProjectRepositoryContract
{
    public function __construct(private Project $model)
    {
    }

    public function create(string $name): Project
    {
        return $this->model->create([
            'name' => $name,
        ]);
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function findById(int $id): ?Project
    {
        return $this->model->find($id);
    }

    public function delete(Project $project): ?bool
    {
        return $project->delete();
    }

    public function update(Project $project, string $name): Project
    {
        $project->update([
            'name' => $name,
        ]);

        return $project;
    }

    public function assignUsersToProject(int $projectId, array $userIds): bool
    {
        $project = $this->findById($projectId);
        if ($project === null) {
            return false;
        }

        $validUserIds = User::whereIn('id', $userIds)->pluck('id')->toArray();
        return $project->users()->sync($validUserIds) !== false;
    }
}
