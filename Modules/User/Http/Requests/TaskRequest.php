<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\DataTransfer\Requests\TaskDTO;

class TaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
            'parent_id' => 'nullable|exists:tasks,id',
            'assignee_id' => 'nullable|exists:users,id',
            'status' => 'required|boolean',
        ];
    }

    /**
     * Custom error messages for validation.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The task title is required.',
            'project_id.required' => 'A project ID is required.',
            'project_id.exists' => 'The project ID must exist in the projects table.',
            'parent_id.exists' => 'The parent task ID must exist in the tasks table.',
            'assignee_id.exists' => 'The assignee ID must exist in the users table.',
            'status.required' => 'The task status is required.',
        ];
    }

    /**
     * Convert the validated request into a Data Transfer Object (DTO).
     */
    public function getDTO(): TaskDTO
    {
        return TaskDTO::create(
            $this->input('parent_id') ? (int) $this->input('parent_id') : null,
            (int) $this->input('project_id'),
            $this->input('title'),
            $this->input('description'),
            (bool) $this->input('status'),
            $this->input('assignee_id') ? (int) $this->input('assignee_id') : null
        );
    }
}
