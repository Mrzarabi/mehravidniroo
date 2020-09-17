<?php

namespace App\Http\Resources\Api\V1\Role;

use App\Http\Resources\Api\V1\User\UserCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map( function($item){
            return [
                'name' => $item->name,
                // 'users' => new UserCollection($item->id)
            ];
        });
    }
}
