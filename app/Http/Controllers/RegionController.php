<?php

namespace App\Http\Controllers;

use App\Eloquent\Region;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\RegionResource;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ?? self::ITEMS_PER_PAGE;

        $regions = QueryBuilder::for(Region::class)
            ->allowedIncludes('provinces', 'districts')
            ->paginate($perPage);

        return RegionResource::collection($regions);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Region  $region
     */
    public function show(Request $request, Region $region)
    {
        $query = Region::where('id', $region->id);

        $region = QueryBuilder::for($query)
            ->allowedIncludes('provinces', 'districts')
            ->first();
            
        return new RegionResource($region);
    }
}
