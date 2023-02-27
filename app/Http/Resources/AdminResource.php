<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->level == 1){
            $level = "Administrator";
        }
        return [
            "name" => $this->name,
            "username" => $this->username,
            "email" => $this->email,
            "registration" => $this->created_at,
            "level" => $level,
        ];
    }
}
