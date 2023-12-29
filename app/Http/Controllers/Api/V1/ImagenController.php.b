<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
      $auth = Auth::user();

      Log::info($request);

      return response()->json(['message' => 'Image uploaded successfully'], 200);
  }


}
