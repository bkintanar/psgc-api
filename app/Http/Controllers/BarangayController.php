<?php

namespace App\Http\Controllers;

use App\Eloquent\Barangay;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\BarangayResource;

class BarangayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ?? self::ITEMS_PER_PAGE;

        $barangays = QueryBuilder::for(Barangay::class);

        if ($perPage === 'all') {
            return BarangayResource::collection($barangays->get());
        }

        return BarangayResource::collection($barangays->paginate($perPage));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Barangay  $barangay
     */
    public function show(Request $request, Barangay $barangay)
    {
        $query = Barangay::where('id', $barangay->id);

        $barangay = QueryBuilder::for($query)
            ->first();

        return new BarangayResource($barangay);
    }
}
