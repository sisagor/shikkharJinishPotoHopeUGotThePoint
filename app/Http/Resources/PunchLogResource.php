<?php

namespace App\Http\Resources;

use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PunchLogResource extends JsonResource
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
          'date' => Carbon::parse($this->punch_time)->format('Y-m-d'),
          'punch_time' => Carbon::parse($this->punch_time)->format('h:i:s a'),
          'location' => $this->location,
        ];
    }


}
