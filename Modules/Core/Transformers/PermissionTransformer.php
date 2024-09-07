<?php

namespace Modules\Core\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Core\Entities\Permission;

/** @mixin Permission */
class PermissionTransformer extends JsonResource
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
            "action"   => "manage",
            "subject" => $this->slug,
            "uuid" => $this->permission_uuid,
        ];
    }
}
