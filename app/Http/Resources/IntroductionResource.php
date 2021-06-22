<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IntroductionResource extends JsonResource
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
            'order' => $this->order,
            'image' => $this->image,
            'title' => $this->title,
            'summary' => $this->summary,
        ];
    }
}
