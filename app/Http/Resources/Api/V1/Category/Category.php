<?php

namespace App\Http\Resources\Api\V1\Category;

use App\Http\Resources\Api\V1\Product\ProductCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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
            'title' => $this->title,
            'desc' => $this->desc,
            'image' => $this->image,
            'children' => new SubCategoryCollection($this->categories),
            'products' => new ProductCollection($this->products)
        ];
    }
}
