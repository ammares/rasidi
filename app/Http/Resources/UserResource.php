<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'location' => $this->location,
            'solar_pv' => $this->solar_pv,
            'battery_storage' => $this->battery_storage,
            'provider_id' => new ProviderResource($this->whenLoaded('provider')),
            'country_id' => $this->country_id,
            'city' => $this->city,
        ];
    }
}
