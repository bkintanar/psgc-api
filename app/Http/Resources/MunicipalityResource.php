<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MunicipalityResource extends JsonResource
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
        $condition = $request->include != 'municipalities' && ! is_null($request->municipality);

        return [
            'code'         => $this->code,
            'name'         => $this->name,
            'income_class' => $this->income_class,
            'population'   => $this->population,
            'barangays'    => BarangayResource::collection($this->whenLoaded('barangays')),
            'province'     => $this->when($condition, new ProvinceResource($this->province)),
            'region'       => $this->when($condition, new RegionResource($this->province->region)),
        ];
    }
}
