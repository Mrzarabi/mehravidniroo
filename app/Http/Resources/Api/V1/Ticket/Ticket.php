<?php

namespace App\Http\Resources\Api\V1\Ticket;

use App\Models\Ticket as ModelsTicket;
use Illuminate\Http\Resources\Json\JsonResource;

class Ticket extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'image' => $this->image,
            'title' => $this->title,
            'body' => $this->body,
            'status' => $this->stauts,
            'time' => jdate($this->created_at)->format('%B %d، %Y'),
            'answer' => new TicketCollection(ModelsTicket::where('ticket_id', $this->id)->get())
        ];
    }
}
