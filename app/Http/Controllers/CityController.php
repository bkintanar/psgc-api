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
        $perPage = $request->per_page ?? self::ITEMS_PER_PAGE;

        $cities = QueryBuilder::for(City::class)
            ->allowedIncludes('barangays', 'subMunicipalities')
            ->paginate($perPage);

        return CityResource::collection($cities);
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
