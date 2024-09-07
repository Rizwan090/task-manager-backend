<?php

namespace Modules\Core\Http\Requests;

use Modules\Core\Http\Requests\BaseRequest;
use Modules\Core\DataTransfer\Requests\PermissionDTO;

class UpdatePermissionRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => ["required"],
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Name is required",
        ];
    }

    /**
     * @return PermissionDTO
     */
    public function getDTO(): PermissionDTO
    {
        return PermissionDTO::create(
            $this->input('name'),
        );
    }
}
