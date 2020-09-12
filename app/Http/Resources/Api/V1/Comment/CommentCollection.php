<?php

namespace App\Http\Resources\Api\V1\Comment;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            $this->collection->map( function($item) {
                return [
                    'id' => $item->id,
                    'body' => $item->body,
                    'children' => new CommentCollection( $item->comments ),
                    'writter' => $item->user->name . $item->user->family,
                    // 'is_show' => $item->is_show,
                    // 'status' => $item->status 
                ];
            })
        ];
    }
}
