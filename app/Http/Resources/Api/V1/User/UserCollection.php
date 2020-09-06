<?php

namespace App\Http\Resources\Api\V1\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
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
                    'id'   => $item->id,
                    'avatar'   => $item->avatar,
                    'name'   => $item->name,
                    'family'   => $item->family,
                    'address'   => $item->address,
                    'phone_number'   => $item->phone_number,
                    'national_code'   => $item->national_code,
                    'email' => $item->email,
                ];
            })
        ];
    }
}
