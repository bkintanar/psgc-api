<?php

namespace App\Http\Controllers;

use App\Eloquent\District;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\DistrictResource;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ?? self::ITEMS_PER_PAGE;

        $districts = QueryBuilder::for(District::class)
            ->allowedIncludes('cities', 'municipalities')
            ->paginate($perPage);

        return DistrictResource::collection($districts);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param District  $district
     */
    public function show(Request $request, District $district)
    {
        $query = District::where('id', $district->id);

        $district = QueryBuilder::for($query)
            ->allowedIncludes('cities', 'municipalities')
            ->first();
            
        return new DistrictResource($district);
    }
}
