<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Field extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'subscriber_id' => $this->subscriber_id,
            'title' => $this->title,
            'type' => $this->type,
        ];
    }
}
