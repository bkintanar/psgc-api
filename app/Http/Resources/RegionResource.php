<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'code'       => $this->code,
            'name'       => $this->name,
            'population' => $this->population,
            'provinces'  => ProvinceResource::collection($this->whenLoaded('provinces')),
            'districts'  => DistrictResource::collection($this->whenLoaded('districts')),
        ];
    }
}
