<?php

namespace Modules\Admin\Contracts\Services;

use Illuminate\Support\Collection;
use Modules\Admin\DataTransfer\Requests\ProjectDTO;
use Modules\Admin\Entities\Project;

interface ProjectContract
{
    public function create(ProjectDTO $projectDTO): Project;
    public function getAll(): Collection;
    public function findById(int $id): ?Project;
    public function delete(Project $project): ?bool;
    public function update(Project $project, ProjectDTO $projectDTO): Project;
}
