<?php

namespace App\Http\Controllers\API\V1;

use App\Models\CalendarioActividades;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CalendarioActividadesResource;
use App\Http\Resources\V1\CalendarioActividadesCollection;
use App\Filters\V1\CalendarioActividadesFilter;
use App\Http\Requests\V1\StoreCalendarioActividadesRequest;
use App\Http\Requests\V1\UpdateCalendarioActividadesRequest;
use App\Http\Requests\V1\EnrolCalendarioActividadesRequest;

class CalendarioActividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $calendarioActividades = NULL;

        $filter = new CalendarioActividadesFilter();
        $filterItems = $filter->transform($request); //[['columna', 'operador', 'valor']]

        // Se comprueba si tenemos el parametro Titulo
        $filtradoTitulo=$request->query('titulo');

        if ($filtradoTitulo && isset($filtradoTitulo['lk'])) {
            $calendarioActividades = CalendarioActividades::whereRelation('actividad', $filterItems)->with('actividad')->orderBy('fecha', 'desc');
        } else {
            $calendarioActividades = CalendarioActividades::where($filterItems)->with('actividad')->orderBy('fecha', 'desc');
        }

        return new CalendarioActividadesCollection($calendarioActividades->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCalendarioActividadesRequest $request)
    {
        return new CalendarioActividadesResource(CalendarioActividades::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(CalendarioActividades $calendarioActividades)
    {
        return new CalendarioActividadesResource($calendarioActividades->loadMissing('actividad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCalendarioActividadesRequest $request, CalendarioActividades $calendarioActividades)
    {
        $calendarioActividades->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CalendarioActividades $calendarioActividades)
    {
        if ($calendarioActividades->delete()) {
            return response()->json(['message' => 'Success'], 204);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }

    public function inscribirUsuarioActividad(EnrolCalendarioActividadesRequest $request)
    {
        $usuario = (!$request->idUsuario ? Auth::user() : User::find($request->idUsuario));
        $actividad = CalendarioActividades::find($request->idActividad);
        try
         {
           $usuario->actividades()->attach($actividad->id);
            return response()->json(['message' => 'Success'], 204);
        } catch (Exception $e) {
            return response()->json(['message' => 'Bad request'], 400);
        }
    }

    public function borrarUsuarioActividad(EnrolCalendarioActividadesRequest $request)
    {
        $usuario = (!$request->idUsuario ? Auth::user() : User::find($request->idUsuario));
        $actividad = CalendarioActividades::find($request->idActividad);
        try
         {
           $usuario->actividades()->detach($actividad->id);
            return response()->json(['message' => 'Success'], 204);
        } catch (Exception $e) {
            return response()->json(['message' => 'Bad request'], 400);
        }
    }

    public function estaInscrito(EnrolCalendarioActividadesRequest $request)
    {
        $usuario = (!$request->idUsuario ? Auth::user() : User::find($request->idUsuario));
        $inscrito = $usuario->actividades()->where('id_actividad_agendada', $request->idActividad);
        if ($inscrito->first()) {
            return response()->json(['message' => 'Success'], 204);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }

    // Devuelve los usuarios inscritos a una actividad
    public function usuariosInscritos(EnrolCalendarioActividadesRequest $request) {
        $inscritos = CalendarioActividades::find($request->idActividad)
            ->miembros()
            ->where('id_actividad_agendada', $request->idActividad);
        return  $inscritos->get();
    }

    // Devuelve las actividades en las que esta inscrita el usuario
    public function actividadesInscritas(Request $request) {
        $actividades = $request->user()
            ->actividades();
        return  new CalendarioActividadesCollection($actividades->with('actividad')->orderBy('fecha', 'desc')->get());
    }


}
