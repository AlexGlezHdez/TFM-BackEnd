<?php

namespace App\Http\Controllers\API\V1;

use App\Models\EntradaBlog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EntradaBlogResource;
use App\Http\Resources\V1\EntradaBlogCollection;
use App\Filters\V1\EntradaBlogFilter;

class EntradaBlogController extends Controller
{
    public function index(Request $request)
    {
        $filter = new EntradaBlogFilter();
        $filterItems = $filter->transform($request); //[['columna', 'operador', 'valor']]

        $includeAutores = $request->query('includeAutores');

        $entradasBlog = EntradaBlog::where($filterItems)->with('autor');

        return new EntradaBlogCollection($entradasBlog->paginate()->appends($request->query()));
    }


    public function show(EntradaBlog $entradaBlog)
    {
        return new EntradaBlogResource($entradaBlog->loadMissing('autor'));
    }
}
