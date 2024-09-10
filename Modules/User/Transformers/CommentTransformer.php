<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Entities\Comment;

class CommentTransformer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Comment $this */
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'task_id' => $this->task_id,
            'content' => $this->content,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'user' => new UserTransformer($this->whenLoaded('user')),
            'replies' => CommentTransformer::collection($this->whenLoaded('replies')),
        ];
    }
}
