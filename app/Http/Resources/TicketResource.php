<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'id'          => $this->id                ,
            'title'       => $this->title             ,
            'description' => $this->description       ,
            'user'        => $this->user->name        ,
            'status'      => $this->status->status    ,
            'priority'    => $this->priority->priority,
            'created_at'  => $this->created_at->format('d-m-Y H:i') ,
            'created_by'  => $this->createdBy->name   ,
            'updated_at'  => $this->updated_at->format('d-m-Y H:i') ,
            'updated_by'  => $this->updatedBy->name   ,
        ];
    }
}
