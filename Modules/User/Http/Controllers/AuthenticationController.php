<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\User\Contracts\Services\UserContract;
use Modules\User\Contracts\Services\AccessTokenContract;
use Modules\User\Enum\UserType;
use Modules\User\Http\Requests\SignInRequest;
use Modules\User\Http\Requests\SignUpRequest;
use Modules\User\Transformers\UserTransformer;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class AuthenticationController extends Controller
{
    public function __construct(
        private readonly UserContract $objUserService,
        private readonly AccessTokenContract $objTokenService
    ) {}


    /**
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     * @throws NotFoundExceptionInterface
     */
    public function signUp(SignUpRequest $objRequest): JsonResponse
    {
        $objUser = $this->objUserService->create($objRequest->getDTO(), UserType::USER);
        $strToken = $this->objTokenService->createAuthToken($objUser);
        return apiResponse()->meta("token", $strToken)->success(new UserTransformer($objUser));
    }
    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws ValidationException
     */
    public function signIn(SignInRequest $objRequest): JsonResponse
    {
        $objDTO = $objRequest->getDTO();

        $objUser = $this->objUserService->findByEmail($objDTO->getEmail());

        if (is_null($objUser) || !$this->objUserService->checkUserPassword($objUser, $objDTO->getPassword())) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $strToken = $this->objTokenService->createAuthToken($objUser);

        return apiResponse()->meta("token", $strToken)->success(new UserTransformer($objUser));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws BindingResolutionException
     * @throws NotFoundExceptionInterface
     */
    public function logout(): JsonResponse
    {
        $objUser = auth()->user();
        $currentToken = $this->objTokenService->getCurrentToken($objUser);
        $this->objTokenService->revokeToken($currentToken);
        return apiResponse()->success('Logged out successfully.');
    }
}
