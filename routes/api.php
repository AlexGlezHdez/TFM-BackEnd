<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\UserController;

use App\Http\Controllers\Api\V1\EntradaBlogController;
use App\Http\Controllers\Api\V1\AutorController;
use App\Http\Controllers\Api\V1\CentroBuceoController;
use App\Http\Controllers\Api\V1\CursoController;
use App\Http\Controllers\Api\V1\CalendarioCursosController;
use App\Http\Controllers\Api\V1\CalendarioActividadesController;
use App\Http\Controllers\Api\V1\ImagenController;
use App\Http\Controllers\Api\V1\ContactoController;


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



Route::apiResource('v1/users', UserController::class)
    ->middleware('auth:sanctum');
//    ->only(['index', 'show'])

Route::post('v1/password', [UserController::class, 'changePassword'])->middleware('auth:sanctum');

// Rutas de autenticacion
Route::post('login', [
    App\Http\Controllers\Api\V1\LoginController::class,
    'login'
]);
Route::post('logout', [
    App\Http\Controllers\Api\V1\LoginController::class,
    'logout'
])->middleware('auth:sanctum');
Route::post('admin', [
    App\Http\Controllers\Api\V1\LoginController::class,
    'admin'
])->middleware('auth:sanctum');

Route::post('v1/calendario-actividades/enrol', [CalendarioActividadesController::class, 'inscribirUsuarioActividad'])
    ->middleware('auth:sanctum');
Route::get('v1/calendario-actividades/enrol/{idActividad}', [CalendarioActividadesController::class, 'estaInscrito'])
    ->middleware('auth:sanctum');
Route::delete('v1/calendario-actividades/enrol/{idActividad}', [CalendarioActividadesController::class, 'borrarUsuarioActividad'])
    ->middleware('auth:sanctum');
Route::get('v1/calendario-actividades/enroled/{idActividad}', [CalendarioActividadesController::class, 'usuariosInscritos'])
    ->middleware('auth:sanctum');
Route::get('v1/calendario-actividades/enroled', [CalendarioActividadesController::class, 'actividadesInscritas'])
    ->middleware('auth:sanctum');


Route::post('v1/imagenes', [ImagenController::class, 'uploadImage'])->middleware('auth:sanctum');

Route::post('v1/contacto', [ContactoController::class, 'enviarMensaje']);

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

    Route::apiResource('centros', CentroBuceoController::class)
        ->only('index', 'show')
        ->parameters(['centros' => 'centroBuceo']);
    Route::apiResource('centros', CentroBuceoController::class)
        ->except('index', 'show')
        ->middleware('auth:sanctum')
        ->parameters(['centros' => 'centroBuceo']);

    Route::apiResource('cursos', CursoController::class)
        ->middleware('auth:sanctum')
        ->parameters(['cursos' => 'curso']);

    Route::apiResource('calendario-cursos', CalendarioCursosController::class)
        ->only('index', 'show')
        ->parameters(['calendario-cursos' => 'calendarioCursos']);
    Route::apiResource('calendario-cursos', CalendarioCursosController::class)
        ->except('index', 'show')
        ->middleware('auth:sanctum')
        ->parameters(['calendario-cursos' => 'calendarioCursos']);

    Route::apiResource('actividades', ActividadController::class)
        ->middleware('auth:sanctum')
        ->parameters(['actividades' => 'actividad']);

    Route::apiResource('calendario-actividades', CalendarioActividadesController::class)
        ->only('index', 'show')
        ->parameters(['calendario-actividades' => 'calendarioActividades']);
    Route::apiResource('calendario-actividades', CalendarioActividadesController::class)
        ->except('index', 'show')
        ->middleware('auth:sanctum')
        ->parameters(['calendario-actividades' => 'calendarioActividades']);

//    Route::apiResource('imagenes', ImagenController::class)
//        ->only('store');

});

