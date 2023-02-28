<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CutyRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->cuty_status == null){
            $cuty_status = "Menunggu";
        }elseif($this->cuty_status == 1){
            $cuty_status = "Disetujui";
        }elseif($this->cuty_status == 2){
            $cuty_status = "Tidak Disetujui";
        }
        return [
            "id" => $this->id,
            "employee_id" => $this->employee_id,
            "name" => $this->employee->user->name,
            "cuty_start" => $this->cuty_start,
            "cuty_end" => $this->cuty_end,
            "date_work" => $this->date_work,
            "cuty_total" => $this->cuty_total,
            "cuty_description" => $this->cuty_description,
            "cuty_status" => $cuty_status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
