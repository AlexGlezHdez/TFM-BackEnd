<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Autor;
use Illuminate\Http\Request;
use App\Http\Resources\V1\AutorResource;
use App\Http\Resources\V1\AutorCollection;
use App\Filters\V1\AutorFilter;
use App\Http\Requests\V1\StoreAutorRequest;
use App\Http\Requests\V1\UpdateAutorRequest;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new AutorFilter();
        $queryItems = $filter->transform($request); //[['columna', 'operador', 'valor']]

        $includeEntradasBlog = $request->query('includeEntradas');

        $autores = Autor::where($queryItems)->with('entradas');

        return new AutorCollection($autores->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAutorRequest $request)
    {
        return new AutorResource(Autor::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Autor $autor)
    {
        return new AutorResource($autor->loadMissing('entradas'));
        //return Autor::where('id','=',1)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAutorRequest $request, Autor $autor)
    {
        $autor->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Autor $autor)
    {
        //
    }
}
