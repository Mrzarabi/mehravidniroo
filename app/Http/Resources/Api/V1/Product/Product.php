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
        if( auth()->user() ) {

            $user = auth()->user();
            if( $user->hasRole([
                '3362c127-65aa-4950-b14f-2fc86b53ea88',
                '100e82ba-e1c0-4153-8633-e1bd228f7399' ])) {

                    return [
                        'id'    => $this->id,
                        'category' => $this->category ? $this->category->title : '',
                        'category_id' => $this->category ? $this->category->id : '',
                        'title' => $this->title,
                        'desc' => $this->desc,
                        'body' => $this->body,
                        'u_price' => $this->u_price,
                        'c_price' => $this->c_price,
                        'inventory' => $this->inventory,
                        'images' => new ImageCollection(Image::where('product_id', $this->id)->get()),
                        'comments' => new CommentCollection(Comment::where('product_id', $this->id)->get()),
                    ];

                } else {
                    return [
                        'id'    => $this->id,
                        'category' => $this->category ? $this->category->title : '',
                        'category_id' => $this->category ? $this->category->id : '',
                        'title' => $this->title,
                        'desc' => $this->desc,
                        'body' => $this->body,
                        // 'u_price' => $this->u_price,
                        'c_price' => $this->c_price,
                        'inventory' => $this->inventory,
                        'images' => new ImageCollection(Image::where('product_id', $this->id)->get()),
                        'comments' => new CommentCollection(Comment::where('product_id', $this->id)->get()),
                    ];
                }
        } else {
            return [
                'id'    => $this->id,
                'category' => $this->category ? $this->category->title : '',
                'category_id' => $this->category ? $this->category->id : '',
                'title' => $this->title,
                'desc' => $this->desc,
                'body' => $this->body,
                'c_price' => $this->c_price,
                'inventory' => $this->inventory,
                'images' => new ImageCollection(Image::where('product_id', $this->id)->get()),
                'comments' => new CommentCollection(Comment::where('product_id', $this->id)->get()),
            ];
        }
    }
}
