<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Actividad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ActividadResource;
use App\Http\Resources\V1\ActividadCollection;
use App\Filters\V1\ActividadFilter;
use App\Http\Requests\V1\StoreActividadRequest;
use App\Http\Requests\V1\UpdateActividadRequest;


class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new ActividadFilter();
        $filterItems = $filter->transform($request); //[['columna', 'operador', 'valor']]

        $actividades = Actividad::where($filterItems)->orderBy('titulo', 'asc');

        return new ActividadCollection($actividades->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActividadRequest $request)
    {
        return new ActividadResource(Actividad::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Actividad $actividad)
    {
        return new ActividadResource($actividad);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActividadRequest $request, Actividad $actividad)
    {
        $actividad->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actividad $actividad)
    {
        if ($actividad->delete()) {
            return response()->json(['message' => 'Success'], 204);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}
