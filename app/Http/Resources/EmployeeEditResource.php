<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeEditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "nik" => $this->nik,
            "name" => $this->user->name,
            "email" => $this->user->email,
            "position_id" => $this->position_id,
            "shift_id" => $this->shift_id,
            "location_id" => $this->location_id,
            "photo" => $this->photo,
        ];
    }
}
