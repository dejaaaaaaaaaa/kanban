<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketHistoryResource extends JsonResource
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
            'id'          => $this->id                              ,
            'ticket'      => $this->ticket->title                   ,
            'action'      => $this->ticket_action                   ,
            'user'        => $this->user->name                      ,
            'created_at'  => $this->created_at->format('d-m-Y H:i') ,
        ];
    }
}
