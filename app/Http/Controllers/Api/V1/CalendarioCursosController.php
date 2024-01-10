<?php

namespace App\Http\Controllers\API\V1;

use App\Models\CalendarioCursos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CalendarioCursosResource;
use App\Http\Resources\V1\CalendarioCursosCollection;
use App\Filters\V1\CalendarioCursosFilter;
use App\Http\Requests\V1\StoreCalendarioCursosRequest;
use App\Http\Requests\V1\UpdateCalendarioCursosRequest;

class CalendarioCursosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new CalendarioCursosFilter();
        $filterItems = $filter->transform($request); //[['columna', 'operador', 'valor']]

        //$includeCursos = $request->query('includeCursos');
        //$calendarioCursos = CalendarioCursos::where($filterItems)->with('curso')->orderBy('fecha', 'desc');
        //return new CalendarioCursosCollection($calendarioCursos->paginate()->appends($request->query()));

        $filtradoTitulo=$request->query('titulo');

        if ($filtradoTitulo && isset($filtradoTitulo['lk'])) {
            $calendarioCursos = CalendarioCursos::whereRelation('curso', $filterItems)->with('curso')->orderBy('fecha', 'desc');
        } else {
            $calendarioCursos = CalendarioCursos::where($filterItems)->with('curso')->orderBy('fecha', 'desc');
        }

        //return new calendarioCursosCollection($calendarioCursos->paginate()->appends($request->query()));
        return new calendarioCursosCollection($calendarioCursos->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCalendarioCursosRequest $request)
    {
        return new CalendarioCursosResource(CalendarioCursos::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(CalendarioCursos $calendarioCursos)
    {
        return new CalendarioCursosResource($calendarioCursos->loadMissing('curso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCalendarioCursosRequest $request, CalendarioCursos $calendarioCursos)
    {
        $calendarioCursos->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CalendarioCursos $calendarioCursos)
    {
        if ($calendarioCursos->delete()) {
            return response()->json(['message' => 'Success'], 204);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}
