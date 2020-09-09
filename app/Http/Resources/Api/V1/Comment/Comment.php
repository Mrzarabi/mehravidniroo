<?php

namespace App\Http\Resources\Api\V1\Comment;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'body' => $this->body,
            'status' => $this->status,
            'is_show' => $this->show
        ];
    }
}
