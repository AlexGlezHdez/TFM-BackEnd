<?php

namespace App\Http\Controllers\API\V1;

use App\Models\CentroBuceo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CentroBuceoResource;
use App\Http\Resources\V1\CentroBuceoCollection;
use App\Filters\V1\CentroBuceoFilter;
use App\Http\Requests\V1\StoreCentroBuceoRequest;
use App\Http\Requests\V1\UpdateCentroBuceoRequest;

class CentroBuceoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new CentroBuceoFilter();
        $filterItems = $filter->transform($request); //[['columna', 'operador', 'valor']]

        $centrosBuceo = CentroBuceo::where($filterItems)->orderBy('nombre', 'asc');

        return new CentroBuceoCollection($centrosBuceo->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCentroBuceoRequest $request)
    {
        return new CentroBuceoResource(CentroBuceo::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(CentroBuceo $centroBuceo)
    {
        return new CentroBuceoResource($centroBuceo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCentroBuceoRequest $request, CentroBuceo $centroBuceo)
    {
        $centroBuceo->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CentroBuceo $centroBuceo)
    {
        if ($centroBuceo->delete()) {
            return response()->json(['message' => 'Success'], 204);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}
