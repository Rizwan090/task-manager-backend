<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Contracts\Services\PermissionContract;
use Modules\Core\Http\Requests\CreatePermissionRequest;
use Modules\Core\Http\Requests\UpdatePermissionRequest;
use Modules\Core\Transformers\PermissionTransformer;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class PermissionController extends Controller
{
    public function __construct(
        private readonly PermissionContract $objPermissionService
    ) {}


    /**
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getPermissions():JsonResponse
    {
        $permissions = $this->objPermissionService->get();
        return apiResponse()->success(PermissionTransformer::collection($permissions));
    }



    /**
     * @param CreatePermissionRequest $request
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function store(CreatePermissionRequest $request): JsonResponse
    {
        $objPermission= $this->objPermissionService->create($request->getDTO());
        return apiResponse()->success(new PermissionTransformer($objPermission));
    }

    /**
     * Show the specified resource.
     * @param string $id
     * @return Renderable
     */
    public function getById(string $id): JsonResponse
    {
        $objPermission = $this->objPermissionService->findByUuid($id);

        if (is_null($objPermission)) {
            throw new \Exception("Permission Not Found.", 404);
        }

        return apiResponse()->success(new PermissionTransformer($objPermission));
    }


    /**
     * @param string $id
     * @param UpdatePermissionRequest $request
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function update(string $id , UpdatePermissionRequest $request): JsonResponse
    {

        $permission = $this->objPermissionService->findByUuid($id);
        if (is_null($permission)) {
            throw new \Exception("Permission Not Found.", 404);
        }
        $objPermission = $this->objPermissionService->update($permission , $request->getDTO());
        return apiResponse()->success(new PermissionTransformer($objPermission));
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $objPermission= $this->objPermissionService->findByUuid($id);
        if (is_null($objPermission)) {
            throw new \Exception("Permission Not Found.", 404);
        }
        $this->objPermissionService->delete($objPermission);
        return apiResponse()->success("Permission has been deleted");
    }
}
