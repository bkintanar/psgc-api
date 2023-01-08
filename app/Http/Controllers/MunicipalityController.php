<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent\Municipality;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\MunicipalityResource;

class MunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ?? static::ITEMS_PER_PAGE;

        $municipalities = QueryBuilder::for(Municipality::class)->allowedIncludes('barangays');

        if ($perPage === 'all') {
            return MunicipalityResource::collection($municipalities->get());
        }

        return MunicipalityResource::collection($municipalities->paginate($perPage));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Municipality  $municipality
     */
    public function show(Request $request, Municipality $municipality)
    {
        $query = Municipality::where('id', $municipality->id);

        $municipality = QueryBuilder::for($query)
            ->allowedIncludes('barangays')
            ->first();

        return new MunicipalityResource($municipality);
    }
}
