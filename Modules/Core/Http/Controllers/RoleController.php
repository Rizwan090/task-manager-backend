<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\AssignPermissionRequest;
use Modules\Core\Contracts\Services\RoleContract;
use Modules\Core\Http\Requests\CreateRoleRequest;
use Modules\Core\Http\Requests\UpdateRoleRequest;
use Modules\Core\Transformers\RoleTransformer;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class RoleController extends Controller
{
    public function __construct(
        private readonly RoleContract $objRoleService
    ) {}


    /**
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getRoles():JsonResponse
    {
        $roles = $this->objRoleService->get();
        return apiResponse()->success(RoleTransformer::collection($roles));
    }



    /**
     * @param CreateRoleRequest $request
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function store(CreateRoleRequest $request): JsonResponse
    {
        $objRole= $this->objRoleService->create($request->getDTO());
        return apiResponse()->success(new RoleTransformer($objRole));
    }

    /**
     * Show the specified resource.
     * @param string $id
     * @return Renderable
     */
    public function getById(string $id): JsonResponse
    {
        $objRole = $this->objRoleService->findByUuId($id);

        if (is_null($objRole)) {
            throw new \Exception("Role Not Found.", 404);
        }

        return apiResponse()->success(new RoleTransformer($objRole));
    }


    /**
     * @param string $id
     * @param UpdateRoleRequest $request
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function update(string $id , UpdateRoleRequest $request): JsonResponse
    {

        $role = $this->objRoleService->findByUuId($id);
        if (is_null($role)) {
            throw new \Exception("Role Not Found.", 404);
        }
        $objRole = $this->objRoleService->update($role , $request->getDTO());
        return apiResponse()->success(new RoleTransformer($objRole));
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return Renderable
     */
    public function destroy($id):JsonResponse
    {
        $objRole= $this->objRoleService->findByUuId($id);
        if (is_null($objRole)) {
            throw new \Exception("Role Not Found.", 404);
        }
        $this->objRoleService->delete($objRole);
        return apiResponse()->success("Role has been deleted");
    }

    public function assignPermission(string $uuid , AssignPermissionRequest $assignPermissionRequest):JsonResponse{
        $objRole= $this->objRoleService->findByUuId($uuid);
        if (is_null($objRole)) {
            throw new \Exception("Role Not Found.", 404);
        }
        $objRole = $this->objRoleService->assignPermissions($objRole , $assignPermissionRequest->getDTO());
        return apiResponse()->success(new RoleTransformer($objRole));
    }
}
