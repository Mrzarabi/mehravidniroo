<?php

namespace App\Http\Resources\Api\V1\Image;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ImageCollection extends ResourceCollection
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
                    'id'    => $item->id,
                    'image' => $item->image
                ];
            })
        ];
    }
}
