<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'icon' => $this->icon,
            'comfortable_temperature' => $this->comfortable_temperature,
            'avg_power' => $this->avg_power,
            'common' => $this->common,
            'schedule' => $this->schedule,
        ];
    }
}
