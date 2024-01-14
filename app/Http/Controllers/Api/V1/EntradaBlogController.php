<?php

namespace App\Http\Controllers\API\V1;

use App\Models\EntradaBlog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EntradaBlogResource;
use App\Http\Resources\V1\EntradaBlogCollection;
use App\Filters\V1\EntradaBlogFilter;
use App\Http\Requests\V1\StoreEntradaBlogRequest;
use App\Http\Requests\V1\UpdateEntradaBlogRequest;

class EntradaBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new EntradaBlogFilter();
        $filterItems = $filter->transform($request); //[['columna', 'operador', 'valor']]

        $includeAutores = $request->query('includeAutores');

        $entradasBlog = EntradaBlog::where($filterItems)->with('autor')->orderBy('fecha_publicacion', 'desc');

//        return new EntradaBlogCollection($entradasBlog->paginate()->appends($request->query()));
        return new EntradaBlogCollection($entradasBlog->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntradaBlogRequest $request)
    {
        return new EntradaBlogResource(EntradaBlog::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(EntradaBlog $entradaBlog)
    {
        return new EntradaBlogResource($entradaBlog->loadMissing('autor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntradaBlogRequest $request, EntradaBlog $entradaBlog)
    {
        $entradaBlog->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EntradaBlog $entradaBlog)
    {
        if ($entradaBlog->delete()) {
            return response()->json(['message' => 'Success'], 204);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}
