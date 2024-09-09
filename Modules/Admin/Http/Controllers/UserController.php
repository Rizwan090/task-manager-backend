<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\User\Contracts\Services\UserContract;
use Modules\User\Enum\UserType;
use Modules\User\Http\Requests\SignUpRequest;
use Modules\User\Http\Requests\UserUpdateRequest;
use Modules\User\Transformers\UserTransformer;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Illuminate\Contracts\Container\BindingResolutionException;

final class UserController extends Controller
{
    public function __construct(private readonly UserContract $userService) {}

    /**
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     * @throws NotFoundExceptionInterface
     */
    public function getAll(): JsonResponse
    {
        $users = $this->userService->getAll();
        return apiResponse()->success(UserTransformer::collection($users));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     * @throws NotFoundExceptionInterface
     */
    public function store(SignUpRequest $request): JsonResponse
    {
        $userType = UserType::USER;
        $user = $this->userService->create($request->getDTO(), $userType);
        return apiResponse()->success(new UserTransformer($user));
    }




    /**
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     * @throws NotFoundExceptionInterface
     */
    public function update(int $id, UserUpdateRequest $request): JsonResponse
    {
        $user = $this->userService->findById($id);
        if (is_null($user)) {
            throw new \Exception("User not found.", 404);
        }

        $updatedUser = $this->userService->edit($user, $request->getDTO());
        return apiResponse()->success(new UserTransformer($updatedUser));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws BindingResolutionException
     */
    public function destroy(int $id): JsonResponse
    {
        $user = $this->userService->findById($id);
        if (is_null($user)) {
            throw new \Exception("User not found.", 404);
        }

        $this->userService->delete($user);
        return apiResponse()->success("User has been deleted.");
    }
}
