<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Admin\Contracts\Services\ProjectContract;
use Modules\Admin\Http\Requests\ProjectRequest;
use Modules\Admin\Transformers\ProjectTransformer;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Illuminate\Contracts\Container\BindingResolutionException;

final class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectContract $projectService
    ) {}

    /**
     * Get all projects with optional pagination.
     *
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     * @throws NotFoundExceptionInterface
     */
    public function getAll(): JsonResponse
    {
        $projects = $this->projectService->getAll();
        return apiResponse()->success(ProjectTransformer::collection($projects));
    }

    /**
     * Store a new project.
     *
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     * @throws NotFoundExceptionInterface
     */
    public function store(ProjectRequest $request): JsonResponse
    {
        $projectDTO = $request->getDTO();
        $project = $this->projectService->create($projectDTO);
        return apiResponse()->success(new ProjectTransformer($project));
    }

    /**
     * Get a project by ID.
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws BindingResolutionException
     */
    public function getById(int $id): JsonResponse
    {
        $project = $this->projectService->findById($id);

        if (is_null($project)) {
            throw new \Exception("Project Not Found.", 404);
        }

        return apiResponse()->success(new ProjectTransformer($project));
    }

    /**
     * Update an existing project.
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws BindingResolutionException
     */
    public function update(ProjectRequest $request, int $id): JsonResponse
    {
        $project = $this->projectService->findById($id);

        if (is_null($project)) {
            throw new \Exception("Project Not Found.", 404);
        }

        $projectDTO = $request->getDTO();
        $updatedProject = $this->projectService->update($project, $projectDTO);

        return apiResponse()->success(new ProjectTransformer($updatedProject));
    }

    /**
     * Delete a project.
     *
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     * @throws NotFoundExceptionInterface
     */
    public function destroy(int $id): JsonResponse
    {
        $project = $this->projectService->findById($id);

        if (is_null($project)) {
            throw new \Exception("Project Not Found.", 404);
        }

        $this->projectService->delete($project);

        return apiResponse()->success("Project has been deleted.");
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     */
    public function assignUsers(int $projectId, ProjectRequest $request): JsonResponse
    {
        $userIds = $request->input('user_ids');
        if (empty($userIds)) {
            return apiResponse()->error('No user IDs provided.');
        }

        $success = $this->projectService->assignUsersToProject($projectId, $userIds);

        if ($success) {
            return apiResponse()->success('Users assigned to project successfully.');
        }

        return apiResponse()->error('Failed to assign users to project.');
    }
}
