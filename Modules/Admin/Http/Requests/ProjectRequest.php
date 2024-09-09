<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admin\DataTransfer\Requests\ProjectDTO;

class ProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The project name field is required.',
            'name.string' => 'The project name must be a string.',
            'name.max' => 'The project name may not be greater than 255 characters.',
        ];
    }

    /**
     * Get the ProjectDTO from the request data.
     *
     * @return ProjectDTO
     */
    public function getDTO(): ProjectDTO
    {
        return ProjectDTO::create(
            $this->input('name')
        );
    }
}
