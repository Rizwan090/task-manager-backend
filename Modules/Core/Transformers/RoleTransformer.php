<?php

namespace Modules\Core\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Core\Entities\Role;

/** @mixin Role */
class RoleTransformer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name"   => $this->name,
            "slug" => $this->slug,
            "uuid" => $this->role_uuid,
            "permissions" => PermissionTransformer::collection($this->permissions)
        ];
    }
}
