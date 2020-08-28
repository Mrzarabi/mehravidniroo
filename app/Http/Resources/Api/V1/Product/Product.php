<?php

namespace App\Http\Resources\Api\V1\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'category' => $this->category->title,
            'title' => $this->title,
            'desc' => $this->desc,
            'body' => $this->body,
            'images' => $this->images,
            'u_price' => $this->u_price,
            'c_price' => $this->c_price,
            'inventory' => $this->inventory,
        ];
    }
}
