<?php

namespace App\Http\Controllers;

use App\Eloquent\City;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use Spatie\QueryBuilder\QueryBuilder;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ?? static::ITEMS_PER_PAGE;

        $cities = QueryBuilder::for(City::class)->allowedIncludes('barangays', 'subMunicipalities');

        if ($perPage === 'all') {
            return CityResource::collection($cities->get());
        }

        return CityResource::collection($cities->paginate($perPage));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param City  $city
     */
    public function show(Request $request, City $city)
    {
        $query = City::where('id', $city->id);

        $city = QueryBuilder::for($query)
            ->allowedIncludes('barangays', 'subMunicipalities')
            ->first();

        return new CityResource($city);
    }
}
