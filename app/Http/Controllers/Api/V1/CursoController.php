<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CursoResource;
use App\Http\Resources\V1\CursoCollection;
use App\Filters\V1\CursoFilter;
use App\Http\Requests\V1\StoreCursoRequest;
use App\Http\Requests\V1\UpdateCursoRequest;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new CursoFilter();
        $filterItems = $filter->transform($request); //[['columna', 'operador', 'valor']]

        $cursos = Curso::where($filterItems)->orderBy('titulo', 'asc');

        return new CursoCollection($cursos->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCursoRequest $request)
    {
        return new CursoResource(Curso::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        return new CursoResource($curso);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCursoRequest $request, Curso $curso)
    {
        $curso->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        if ($curso->delete()) {
            return response()->json(['message' => 'Success'], 204);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}
