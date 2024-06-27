<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\Nivel;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('profesor')) {
            $profesor = $user->profesor;
            $grupos = $profesor->grupos;
            $niveles = Nivel::all();
            return view('pages.grupo.index', compact('grupos', 'niveles'));
        }
        if ($user->hasRole('tutor')) {
            $tutor = $user->tutor;
            $estudiantes = $tutor->estudiantes()->with('user.grupoUsers.grupo')->get();

            // Obtener todos los grupos únicos asociados a los estudiantes del tutor
            $grupos = $estudiantes->flatMap(function ($estudiante) {
                return $estudiante->user->grupoUsers->pluck('grupo');
            })->unique('id')->values()->all();
            // $usuariosConGrupo->load('grupo');
            $niveles = Nivel::all();
            return view('pages.grupo.index', compact('grupos', 'niveles'));
        }
        return view('pages.utility.404');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $niveles = Nivel::all();
        return view('pages.grupo.create', compact('niveles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'fecha_creacion' => 'required|date',
            'nivel_id' => 'required|exists:nivels,id',
            'profesor_id' => 'required|exists:profesors,id',
        ]);
        $nivel = Nivel::with('imagenes')->find($request->nivel_id);

        // Verificar que los niveles existen y tienen imágenes antes de continuar
        if (!$nivel || !$nivel->imagenes->isNotEmpty()) {
            $nivelImage = null;
        } else {
            $nivelImage = $nivel->imagenes->random()->url;
        }

        Grupo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'foto' => $nivelImage,
            'fecha_creacion' => $request->fecha_creacion,
            'nivel_id' => $request->nivel_id,
            'profesor_id' => $request->profesor_id,
        ]);
        return redirect()->route('admin.grupo.index')->with('success', 'Grupo creado con éxito.');
    }

    public function storeEstudianteChat($id, Request $request)
    {
        $request->validate([
            'colaboradores' => 'required'
        ]);

        $grupo = Grupo::find($id);
        $users_ids = json_decode($request->colaboradores);
        foreach ($users_ids as $user_id) {
            // Crear la notificación para cada usuario que se crea su sesion_user
            $user = User::find($user_id);
            $grupo->grupoUsers()->create([
                'fecha_registro' => now(),
                'habilitado_chat' => true,
                'habilitado_grupo' => true,
                'user_id' => $user->id
            ]);
            // $sesion->sesionUser()->attach($user_id, ['fecha_invitacion' => Carbon::now()->toDateTimeString(), 'estado' => Sesion::ESPERA]);
            // $user->notify(new UserNotification((string)$sesion->id, "Invitación", $sesion->titulo, "Sesion")); //id,accion,titulo,tabla,time
        }
        return redirect()->route('admin.grupo.show', $grupo->id)->with('success', 'Estudiante añadido exitosamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        if ($user->hasRole('profesor')) {
            $profesor = $user->profesor;
            $grupo = $profesor->grupos->where('id', $id)->first();
            $estudiantes = $grupo->grupoUsers()
                ->where('habilitado_chat', true)
                ->where('habilitado_grupo', true)
                ->whereHas('user.estudiante')
                ->with('user') // Opcional: cargar la relación de usuario
                ->get();
            return view('pages.grupo.show', compact('grupo', 'estudiantes'));
        }
        if ($user->hasRole('tutor')) {
            $tutor = $user->tutor;
            $grupo = Grupo::find($id);
            $estudiantes = $tutor->estudiantes()
                ->whereHas('user.grupoUsers', function ($query) use ($id) {
                    $query->where('grupo_id', $id)
                        ->where('habilitado_chat', true)
                        ->where('habilitado_grupo', true);
                })
                ->with('user') // Opcional: cargar la relación de usuario
                ->get();
            return view('pages.grupo.show', compact('grupo', 'estudiantes'));
        }
        return view('pages.utility.404');
    }
    public function chat(string $id)
    {
        $user = Auth::user();
        if ($user->hasRole('profesor')) {
            $profesor = $user->profesor;

            $grupo = $profesor->grupos->where('id', $id)->first();
            $mensajes = $grupo->mensajes;
            return view('pages.grupo.chat', compact('grupo', 'mensajes'));
        }
        if ($user->hasRole('tutor')) {
            $grupo=Grupo::find($id);
            $mensajes=$grupo->mensajes;
            return view('pages.grupo.chat', compact('grupo', 'mensajes'));
        }
        return view('pages.utility.404');
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
