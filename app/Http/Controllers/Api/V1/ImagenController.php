<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Symfony\Component\HttpFoundation\Request;

use Illuminate\Support\Facades\Log;


class ImagenController extends Controller
{
    public function uploadImage(Request $request)
    {
  /*
        $this->validate($request, [
            'password_actual' => 'required|string',
            'password_nueva' => 'required|min:8|string'
        ]);
  */
        $file = $request->file('imagen');
        $path=$file->storeAs('', $file->getClientOriginalName(),'molamola');

        Log::info('-----');
        Log::info($request->files->get('imagen'));
        Log::info($request);
        Log::info(base_path());
        Log::info('******');
        Log::info($request->hasFile('imagen'));

        return response()->json(['message' => 'Image uploaded successfully at '.$path], 200);
    }

}
