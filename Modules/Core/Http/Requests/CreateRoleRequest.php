<?php

namespace Modules\Core\Http\Requests;

use Modules\Core\Http\Requests\BaseRequest;
use Modules\Core\DataTransfer\Requests\RoleDTO;

class CreateRoleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
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


    public function getDTO(): RoleDTO
    {
        return RoleDTO::create(
            $this->input('name'),
        );
    }
}
