<?php

namespace App\Http\Controllers\API\V1;

use App\Models\CalendarioActividades;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CalendarioActividadesResource;
use App\Http\Resources\V1\CalendarioActividadesCollection;
use App\Filters\V1\CalendarioActividadesFilter;
use App\Http\Requests\V1\StoreCalendarioActividadesRequest;
use App\Http\Requests\V1\UpdateCalendarioActividadesRequest;

class CalendarioActividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $calendarioActividades = NULL;

        $filter = new CalendarioActividadesFilter();
        $filterItems = $filter->transform($request); //[['columna', 'operador', 'valor']]

        // Se comprueba si tenemos el parametro Titulo
        $filtradoTitulo=$request->query('titulo');

        if ($filtradoTitulo && isset($filtradoTitulo['lk'])) {
            $calendarioActividades = CalendarioActividades::whereRelation('actividad', $filterItems)->with('actividad')->orderBy('fecha', 'desc');
        } else {
            $calendarioActividades = CalendarioActividades::where($filterItems)->with('actividad')->orderBy('fecha', 'desc');
        }

        return new CalendarioActividadesCollection($calendarioActividades->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCalendarioActividadesRequest $request)
    {
        return new CalendarioActividadesResource(CalendarioActividades::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(CalendarioActividades $calendarioActividades)
    {
        return new CalendarioActividadesResource($calendarioActividades->loadMissing('actividad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCalendarioActividadesRequest $request, CalendarioActividades $calendarioActividades)
    {
        $calendarioActividades->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CalendarioActividades $calendarioActividades)
    {
        if ($calendarioActividades->delete()) {
            return response()->json(['message' => 'Success'], 204);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}
