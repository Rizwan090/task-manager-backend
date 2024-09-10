<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Entities\Task;
use Modules\Admin\Transformers\ProjectTransformer;

class TaskTransformer extends JsonResource
{
    /**
     * Transform the task resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Task $this */
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'title' => $this->title,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'assignee' => new UserTransformer($this->whenLoaded('assignee')),
            'project' => new ProjectTransformer($this->whenLoaded('project')),
            'subtasks' => TaskTransformer::collection($this->whenLoaded('subtasks')),
            'comments' => CommentTransformer::collection($this->whenLoaded('comments')),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
