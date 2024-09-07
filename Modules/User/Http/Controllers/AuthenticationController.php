<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\User\Contracts\Services\UserContract;
use Modules\User\Contracts\Services\AccessTokenContract;
use Modules\User\Http\Requests\SignInRequest;
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
}
