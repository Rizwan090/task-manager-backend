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
    public function getAllByTaskId(int $taskId): JsonResponse
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
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     */
    public function findById(int $id): JsonResponse
    {
        $comment = $this->commentService->findById($id);
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
    public function update(CommentRequest $request, int $id): JsonResponse
    {
        $commentDTO = $request->getDTO();
        $updatedComment = $this->commentService->update($id, $commentDTO);
        return apiResponse()->success(new CommentTransformer($updatedComment));
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     */
    public function delete(int $id): JsonResponse
    {
        $comment = $this->commentService->findById($id);
        if (is_null($comment)) {
            return apiResponse()->error('Comment not found.', 404);
        }
        $this->commentService->delete($id);
        return apiResponse()->success('Comment has been deleted.');
    }
}
