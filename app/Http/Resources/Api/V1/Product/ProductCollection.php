<?php

namespace App\Http\Resources\Api\V1\Product;

use App\Http\Resources\Api\V1\Image\ImageCollection;
use App\Models\Image;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
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
                        'data' => $this->collection->map( function($item) {
                            return [
                                'id' => $item->id,
                                'category' => $item->category ? $item->category->title : '',
                                'title' => $item->title,
                                'desc' => $item->desc,
                                'u_price' => $item->u_price,
                                'c_price' => $item->c_price,
                                'inventory' => $item->inventory,
                                'images' => new ImageCollection( Image::where('product_id', $item->id)->get() ),
                            ];
                        })
                    ];

                } else {
                    return [
                        'data' => $this->collection->map( function($item) {
                            return [
                                'id' => $item->id,
                                'category' => $item->category ? $item->category->title : '',
                                'title' => $item->title,
                                'desc' => $item->desc,
                                'c_price' => $item->c_price,
                                'inventory' => $item->inventory,
                                'images' => new ImageCollection( Image::where('product_id', $item->id)->get() ),
                            ];
                        })
                    ];
                }
        } else {
            return [
                'data' => $this->collection->map( function($item) {
                    return [
                        'id' => $item->id,
                        'category' => $item->category ? $item->category->title : '',
                        'title' => $item->title,
                        'desc' => $item->desc,
                        'c_price' => $item->c_price,
                        'inventory' => $item->inventory,
                        'images' => new ImageCollection( Image::where('product_id', $item->id)->get() ),
                    ];
                })
            ];
        }
    }
}
