<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\User\Contracts\Services\CommentContract;
use Modules\User\Http\Requests\CommentRequest;
use Modules\User\Transformers\CommentTransformer;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

final class CommentController extends Controller
{
    public function __construct(
        private readonly CommentContract $commentService
    ) {}

    /**
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     * @throws NotFoundExceptionInterface
     */
    public function getAllByTaskId(int $projectId, int $taskId): JsonResponse
    {
        $comments = $this->commentService->getAllByTaskId($taskId);
        return apiResponse()->success(CommentTransformer::collection($comments));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws BindingResolutionException
     */
    public function create(CommentRequest $request): JsonResponse
    {
        $commentDTO = $request->getDTO();
        $comment = $this->commentService->create($commentDTO);
        return apiResponse()->success(new CommentTransformer($comment));
    }

    /**
     * Find a comment by its ID
     *
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     */
    public function findById(int $projectId, int $taskId, int $commentId): JsonResponse
    {
        $comment = $this->commentService->findById($commentId);

        if (is_null($comment)) {
            return apiResponse()->error('Comment not found.', 404);
        }

        return apiResponse()->success(new CommentTransformer($comment));
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     */
    public function update(CommentRequest $request, int $projectId, int $taskId, int $commentId): JsonResponse
    {
        $commentDTO = $request->getDTO();
        $updatedComment = $this->commentService->update($commentId, $commentDTO);

        if (is_null($updatedComment)) {
            return apiResponse()->error('Comment not found or not updated.', 404);
        }

        return apiResponse()->success(new CommentTransformer($updatedComment));
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     */
    public function delete(int $projectId, int $taskId, int $commentId): JsonResponse
    {
        $comment = $this->commentService->findById($commentId);
        if (is_null($comment)) {
            return apiResponse()->error('Comment not found.', 404);
        }

        $this->commentService->delete($commentId);
        return apiResponse()->success('Comment has been deleted.');
    }
}
