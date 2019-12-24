<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Field as FieldResource;

class Subscriber extends JsonResource
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
            'email' => $this->email,
            'name' => $this->name,
            'state' => ucfirst($this->state),
            'fields' => FieldResource::collection($this->fields),
        ];
    }
}
