<?php

namespace App\Http\Resources\Api\V1\Product;

use App\Http\Requests\V1\Images\ImageRequest;
use App\Http\Resources\Api\V1\Comment\CommentCollection;
use App\Http\Resources\Api\V1\Image\ImageCollection;
use App\Models\Comment;
use App\Models\Image;
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
        
        // return Image::where('product_id', $this->id)->get();
        return [
            'id'    => $this->id,
            // 'category' => $this->category ? $this->category->title : '',
            'category' => $this->id,
            'title' => $this->title,
            'desc' => $this->desc,
            'body' => $this->body,
            'u_price' => $this->u_price,
            'c_price' => $this->c_price,
            'inventory' => $this->inventory,
            'images' => new ImageCollection(Image::where('product_id', $this->id)->get()),
            'comments' => new CommentCollection(Comment::where('product_id', $this->id)->get()),
        ];
    }
}
