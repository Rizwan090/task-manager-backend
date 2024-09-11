<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Container\BindingResolutionException;
use Modules\User\Http\Requests\TaskRequest;
use Modules\User\Transformers\TaskTransformer;
use Modules\User\Contracts\Services\TaskContract;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

final class TaskController extends Controller
{
    public function __construct(
        private readonly TaskContract $taskService
    ) {}

    /**
     * Get all tasks within a project.
     *
     * @param int $projectId
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     * @throws NotFoundExceptionInterface
     */
    public function getAll(int $projectId): JsonResponse
    {
        $tasks = $this->taskService->getAllByProjectId($projectId);
        return apiResponse()->success(TaskTransformer::collection($tasks));
    }

    /**
     * Store a new task within a project.
     *
     * @param TaskRequest $request
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     * @throws NotFoundExceptionInterface
     */
    public function store(TaskRequest $request): JsonResponse
    {
        $taskDTO = $request->getDTO();
        $task = $this->taskService->create($taskDTO);
        return apiResponse()->success(new TaskTransformer($task));
    }

    /**
     * Get a task by its ID.
     *
     * @param int $projectId
     * @param int $taskId
     * @param int $id
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws BindingResolutionException
     * @throws \Exception
     */
    public function getById(int $projectId, int $taskId, int $id): JsonResponse
    {
        $user = Auth::user(); // You might want to use this for authorization checks
        $task = $this->taskService->findById($id);

        if (is_null($task)) {
            return apiResponse()->error('Task not found or not assigned to the user.', 404);
        }

        return apiResponse()->success(new TaskTransformer($task));
    }

    /**
     * Update an existing task.
     *
     * @param TaskRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws BindingResolutionException
     */
    public function update(TaskRequest $request, int $id): JsonResponse
    {
        $task = $this->taskService->findById($id);

        if (is_null($task)) {
            return apiResponse()->error('Task not found.', 404);
        }

        $taskDTO = $request->getDTO();
        $updatedTask = $this->taskService->update($task, $taskDTO);
        return apiResponse()->success(new TaskTransformer($updatedTask));
    }

    /**
     * Delete a task.
     *
     * @param int $id
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     * @throws NotFoundExceptionInterface
     */
    public function destroy(int $id): JsonResponse
    {
        $task = $this->taskService->findById($id);

        if (is_null($task)) {
            return apiResponse()->error('Task not found.', 404);
        }

        $this->taskService->delete($task);
        return apiResponse()->success('Task has been deleted.');
    }

    /**
     * Assign a user to a task.
     *
     * @param int $taskId
     * @param int $userId
     * @return JsonResponse
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     */
    public function assignUserToTask(int $taskId, int $userId): JsonResponse
    {
        $task = $this->taskService->findById($taskId);

        if (!$task) {
            return apiResponse()->error('Task not found.', 404);
        }

        $success = $this->taskService->assignUserToTask($task, $userId);

        if ($success) {
            return apiResponse()->success('User assigned to task successfully.');
        }

        return apiResponse()->error('Failed to assign user to task.');
    }
}
