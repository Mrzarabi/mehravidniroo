<?php

namespace App\Http\Resources\Api\V1\Ticket;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TicketCollection extends ResourceCollection
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
            'data' => $this->collection->map( function($item) {
                return [
                    'id'    => $item->id,
                    'image' => $item->image,
                    'name' => $item->name,
                    'email' => $item->email,
                    'phone_number' => $item->phone_number,
                    'status' => $item->stauts,
                    'title' => $item->title,
                ];
            })
        ];
    }
}
