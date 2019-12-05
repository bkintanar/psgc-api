<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
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
        $condition = $request->include != 'districts' && ! is_null($request->district) && is_null($request->city) && is_null($request->city) && is_null($request->subMunicipality) && is_null($request->barangay);

        return [
            'code'       => $this->code,
            'name'       => $this->name,
            'population' => $this->population,
            'region'     => $this->when($condition, new RegionResource($this->region)),
            'cities'     => CityResource::collection($this->whenLoaded('cities')),
        ];
    }
}
