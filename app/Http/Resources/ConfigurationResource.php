<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfigurationResource extends JsonResource
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
          'name' => $this->system_name,
          'phone' => $this->system_phone,
          'email' => $this->system_email,
          'logo' => $this->logo->path,
          'timezone' => $this->timezone->utc,
          'currency_name' => $this->currency->name,
          'currency_symbol' => $this->currency->symbol,
        ];
    }


}
