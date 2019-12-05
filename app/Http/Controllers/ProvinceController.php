<?php

namespace App\Http\Controllers;

use App\Eloquent\Province;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\ProvinceResource;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ?? self::ITEMS_PER_PAGE;

        $provinces = QueryBuilder::for(Province::class)
            ->allowedIncludes('cities', 'municipalities')
            ->paginate($perPage);

        return ProvinceResource::collection($provinces);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Province  $province
     */
    public function show(Request $request, Province $province)
    {
        $query = Province::where('id', $province->id);

        $province = QueryBuilder::for($query)
            ->allowedIncludes('cities', 'municipalities')
            ->first();
            
        return new ProvinceResource($province);
    }
}
