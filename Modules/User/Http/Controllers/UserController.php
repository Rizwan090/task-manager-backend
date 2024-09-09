<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\User\Contracts\Services\UserContract;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\UserUpdateRequest;
use Modules\User\Transformers\UserTransformer;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class UserController extends Controller
{
    public function __construct(
        private readonly UserContract $objUserService
    )
    {
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAuthUser(): JsonResponse
    {
        /** @var User $objUser */
        $objUser = Auth::user();
        return apiResponse()->success(new UserTransformer($objUser));
    }

    /**
     * @param UserUpdateRequest $objRequest
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function updateAuthUser(UserUpdateRequest $objRequest): JsonResponse
    {
        /** @var User $objUser */
        $objUser = Auth::user();

        $objUser = $this->objUserService->edit($objUser, $objRequest->getDTO());

        return apiResponse()->success(new UserTransformer($objUser));
    }


}
