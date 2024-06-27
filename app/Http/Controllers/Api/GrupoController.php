<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Mensaje;
use App\Models\Profesor;
use App\Models\Tutor;
use F9Web\ApiResponseHelpers;

class GrupoController extends Controller
{
    use ApiResponseHelpers;

    public function getGruposByNivel($nivel_id)
    {
        if ($nivel_id == 'all') {
            $grupos = Grupo::all();
        } else {
            $grupos = Grupo::where('nivel_id', $nivel_id)->get();
        }

        return $this->respondWithSuccess($grupos);
    }
    /**
     * Display a listing of the resource.
     */
    public function sendMessage(Request $request, $grupoId)
    {
        $request->validate([
            'txt' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $mensaje = Mensaje::create([
            'txt' => $request->txt,
            'grupo_id' => $grupoId,
            'user_id' => $request->user_id,
        ]);

        $mensaje->load('user');
        return $this->respondWithSuccess($mensaje);
    }
    public function searchUser(Request $request)
    {
        $search = $request->get('query');
        $grupo = Grupo::findOrFail($request->get('grupo_id'));
        $profesor = Profesor::findOrFail($grupo->profesor_id);
        // Carga los estudiantes asociados al profesor a través de la relación estudianteProfesor
        $estudiantes = $profesor->estudianteProfesors()
            ->where('estado', true) // Opcional: puedes aplicar condiciones adicionales si lo necesitas
            ->with('estudiante') // Cargar la relación del estudiante
            ->get();
        // Obtener los IDs de usuario de los usuarios del grupo
        $grupoUsuariosIds = $grupo->grupoUsers->where('habilitado_chat',true)->pluck('user_id')->toArray();
        $estudiantesFueraGrupo = $estudiantes->filter(function ($estudiante) use ($grupoUsuariosIds) {
            return !in_array($estudiante->estudiante->id, $grupoUsuariosIds);
        });
        if (empty($search)) {
            // Obtener una muestra aleatoria de hasta 3 elementos
            $users = $estudiantesFueraGrupo->shuffle()->take(3)->pluck('estudiante.user');
        } else {
            $users = $estudiantesFueraGrupo->filter(function ($estudiante) use ($search) {
                $user = $estudiante->estudiante->user; // Obtener el modelo User asociado al estudiante

                // Realizar la búsqueda en los campos especificados
                $emailMatches = str_contains(strtolower($user->email), strtolower($search));
                $nameMatches = str_contains(strtolower($user->name), strtolower($search));
                $lastnameMatches = str_contains(strtolower($user->lastname), strtolower($search));

                // Retornar true si hay alguna coincidencia en alguno de los campos
                return $emailMatches || $nameMatches || $lastnameMatches;
            })->pluck('estudiante.user');
        }

        return $this->respondWithSuccess($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
