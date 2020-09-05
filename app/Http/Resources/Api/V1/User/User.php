<?php

namespace App\Http\Resources\Api\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class User extends JsonResource
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
            'id'   => $this->id,
            'avatar'   => $this->avatar,
            'name'   => $this->name,
            'family'   => $this->family,
            'address'   => $this->address,
            'phone_number'   => $this->phone_number,
            'national_code'   => $this->national_code,
            'email' => $this->email,
            'api_token' => $this->api_token,
        ];
    }
}
