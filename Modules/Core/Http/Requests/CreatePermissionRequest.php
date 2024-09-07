<?php

namespace Modules\Core\Http\Requests;

use Modules\Core\Http\Requests\BaseRequest;
use Modules\Core\DataTransfer\Requests\PermissionDTO;

class CreatePermissionRequest extends BaseRequest
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


    public function getDTO(): PermissionDTO
    {
        return PermissionDTO::create(
            $this->input('name'),
        );
    }
}
