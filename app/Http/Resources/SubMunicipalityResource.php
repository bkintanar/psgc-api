<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubMunicipalityResource extends JsonResource
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
        $condition = $request->include != 'subMunicipalities' && ! is_null($request->subMunicipality);

        return [
            'code'       => $this->code,
            'name'       => $this->name,
            'population' => $this->population,
            'barangays'  => BarangayResource::collection($this->whenLoaded('barangays')),
            'city'       => $this->when($condition, new CityResource($this->city)),
            'district'   => $this->when($condition, new DistrictResource($this->city->geographic)),
            'region'     => $this->when($condition, new RegionResource($this->city->geographic->region)),
        ];
    }
}
