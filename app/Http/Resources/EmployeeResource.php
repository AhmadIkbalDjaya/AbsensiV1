<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "nik" => $this->nik,
            "name" => $this->user->name,
            "email" => $this->user->email,
            "position" => $this->position->position_name,
            "shift" => $this->shift->shift_name,
            "location" => $this->location->name,
            "created_at" => $this->created_at,
        ];
        // return "tes";
    }
}