<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\DataTransfer\Requests\CommentDTO;

class CommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'parent_id' => 'nullable|exists:comments,id',
            'task_id' => 'required|exists:tasks,id',
            'content' => 'required|string|max:1000',
        ];
    }

    /**
     * Custom error messages for validation.
     */
    public function messages(): array
    {
        return [
            'task_id.required' => 'The task ID is required.',
            'task_id.exists' => 'The task ID must exist in the tasks table.',
            'parent_id.exists' => 'The parent comment ID must exist in the comments table.',
            'content.required' => 'The comment content is required.',
            'content.max' => 'The comment content cannot exceed 1000 characters.',
        ];
    }

    /**
     * Convert the validated request into a Data Transfer Object (DTO).
     */
    public function getDTO(): CommentDTO
    {
        return CommentDTO::create(
            $this->input('parent_id') ? (int) $this->input('parent_id') : null,
            (int) $this->input('task_id'),
            $this->input('content')
        );
    }
}
