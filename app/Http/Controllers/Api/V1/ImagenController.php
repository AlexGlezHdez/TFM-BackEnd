<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Symfony\Component\HttpFoundation\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ImagenController extends Controller
{
    public function uploadImage(Request $request)
    {
        $ubicacion=\App::environment('production')?'molamola_prod':'molamola_dev';
        $file = $request->file('imagen');

        $path=$file->storeAs($request->get('ruta'), $file->getClientOriginalName(),$ubicacion);
        return response()->json(['message' => 'Image uploaded successfully at '.$path], 200);
    }

}
