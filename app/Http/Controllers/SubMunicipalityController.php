<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent\SubMunicipality;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\SubMunicipalityResource;

class SubMunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ?? self::ITEMS_PER_PAGE;

        $cities = QueryBuilder::for(SubMunicipality::class)
            ->allowedIncludes('barangays')
            ->paginate($perPage);

        return SubMunicipalityResource::collection($cities);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param SubMunicipality  $subMunicipality
     */
    public function show(Request $request, SubMunicipality $subMunicipality)
    {
        $query = SubMunicipality::where('id', $subMunicipality->id);

        $subMunicipality = QueryBuilder::for($query)
            ->allowedIncludes('barangays')
            ->first();
            
        return new SubMunicipalityResource($subMunicipality);
    }
}
