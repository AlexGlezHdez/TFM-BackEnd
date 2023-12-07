<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Autor;
use Illuminate\Http\Request;
use App\Http\Resources\V1\AutorResource;
use App\Http\Resources\V1\AutorCollection;
use App\Filters\V1\AutorFilter;

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

        $autores = Autor::where($queryItems)->with('entrada');

        return new AutorCollection($autores->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Autor $autor)
    {
        return new AutorResource($autor->loadMissing('entrada'));
        //return Autor::where('id','=',1)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Autor $autor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Autor $autor)
    {
        //
    }
}
