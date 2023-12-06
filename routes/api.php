<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\EntradaBlogController;
use App\Http\Controllers\Api\V1\AutorController as AutorV1;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
Route::group(['prefix'=>'v1', 'namesapce' => '\App\Http\Controllers\Api\V1'], function() {
    Route::apiResource('noticias', EntradaBlogController::class);
    Route::apiResource('autores', AutorController::class);
});
*/
Route::apiResource('v1/noticias', EntradaBlogController::class)->parameters(['noticias' => 'entradaBlog']);
Route::apiResource('v1/autores', AutorV1::class)->parameters(['autores' => 'autor']);


