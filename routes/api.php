<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\UserController as UserV1;

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



Route::apiResource('v1/users', UserV1::class)
    ->only(['index', 'show'])
    ->middleware('auth:sanctum');

// Rutas de autenticacion
Route::post('login', [
    App\Http\Controllers\Api\V1\LoginController::class,
    'login'
]);
Route::post('logout', [
    App\Http\Controllers\Api\V1\LoginController::class,
    'logout'
])->middleware('auth:sanctum');


// Rutas de acceso a la api
//Route::apiResource('v1/noticias', EntradaBlogController::class)->parameters(['noticias' => 'entradaBlog']);
//Route::apiResource('v1/autores', AutorV1::class)->parameters(['autores' => 'autor']);



Route::group(['prefix'=>'v1', 'namespace' => '\App\Http\Controllers\Api\V1'], function() {
    Route::apiResource('noticias', EntradaBlogController::class)
        ->only('index', 'show')
        ->parameters(['noticias' => 'entradaBlog']);
    Route::apiResource('noticias', EntradaBlogController::class)
        ->except('index', 'show')
        ->middleware('auth:sanctum')
        ->parameters(['noticias' => 'entradaBlog']);

    Route::apiResource('autores', AutorController::class)
        ->only('index', 'show')
        ->parameters(['autores' => 'autor']);
    Route::apiResource('autores', AutorController::class)
        ->except('index', 'show')
        ->middleware('auth:sanctum')
        ->parameters(['autores' => 'autor']);
    });

