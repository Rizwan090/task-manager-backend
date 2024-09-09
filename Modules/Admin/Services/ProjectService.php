<?php

namespace Modules\Admin\Services;

use Illuminate\Support\Collection;
use Modules\Admin\Contracts\Repositories\ProjectRepositoryContract;
use Modules\Admin\Contracts\Services\ProjectContract;
use Modules\Admin\DataTransfer\Requests\ProjectDTO;
use Modules\Admin\Entities\Project;

readonly class ProjectService implements ProjectContract
{
    public function __construct(
        private ProjectRepositoryContract $projectRepository,
    ) {}

    public function create(ProjectDTO $projectDTO): Project
    {
        return $this->projectRepository->create(
            $projectDTO->getName()
        );
    }

    public function getAll(): Collection
    {
        return $this->projectRepository->getAll();
    }

    public function findById(int $id): ?Project
    {
        return $this->projectRepository->findById($id);
    }

    public function delete(Project $project): ?bool
    {
        return $this->projectRepository->delete($project);
    }

    public function update(Project $project, ProjectDTO $projectDTO): Project
    {
        return $this->projectRepository->update(
            $project,
            $projectDTO->getName()
        );
    }

    public function assignUsersToProject(int $projectId, array $userIds): bool
    {
        return $this->projectRepository->assignUsersToProject($projectId, $userIds);
    }
}
