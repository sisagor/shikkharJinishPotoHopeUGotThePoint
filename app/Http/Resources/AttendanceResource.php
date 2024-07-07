<?php

namespace App\Http\Resources;

use App\Models\RootModel;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;


class AttendanceResource extends JsonResource
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
          'date' => Carbon::parse($this->attendance_date)->format('Y-m-d'),
          'checkin_time' => Carbon::parse($this->checkin_time)->format('h:i:s a'),
          'checkout_time' => Carbon::parse($this->checkout_time)->format('h:i:s a'),
          'Late' => $this->late,
          'status' => ($this->status == RootModel::PRESENT ? "Present" : "Absent"),
          'overtime' => $this->overtime,
        ];
    }


}
