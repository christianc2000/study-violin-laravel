<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Models\EstudianteProfesor;
use App\Models\Nivel;
use App\Models\Profesor;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Buscar al profesor por su ID junto con sus estudiantes
        $user = Auth::user();
        if ($user->hasRole('profesor')) {
            // El usuario tiene el rol 'profesor'
            $profesor = Profesor::find($user->id);
            $estudiantes = EstudianteProfesor::where('profesor_id', $profesor->id)
                ->where('estado', true)
                ->with('estudiante.user') // Cargar relaciones necesarias
                ->get();
            $estudiantes = $estudiantes->pluck('estudiante');
            // return $estudiantes;
            return view('pages.estudiante.index', compact('estudiantes'));
        }
        if ($user->hasRole('tutor')) {
            $tutor = Tutor::find($user->id);
            $estudiantes = $tutor->estudiantes;
            $estudiantes->load('user');
            // return $estudiantes;
            return view('pages.estudiante.index', compact('estudiantes'));
        }
        return view('pages.utility.404');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $niveles = Nivel::all();
        return view('pages.estudiante.create', compact('niveles'));
    }
    public function tutor(String $id)
    {
        $tutores = Tutor::all();
        $estudiante = Estudiante::find($id);
        return view('pages.estudiante.tutor', compact('estudiante', 'tutores'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->radioOpcion == "1") { //Si es un estudiante nuevo
            $request->validate([
                'ci' => 'required|string',
                'name' => 'required|string',
                'lastname' => 'required|string',
                'gender' => 'required|string',
                'birth_date' => 'required|date',
                'address' => 'required|string',
                'nivel' => 'required',
                'puntuacion' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            // Manejar la subida de la foto si está presente
            if ($request->hasFile('foto')) {
                $imageName = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('imagenes'), $imageName);
                $path = '/' . 'imagenes/' . $imageName;
            }
            // Hash la contraseña antes de guardar
            $password = bcrypt($request->password);
            $profesor = Auth::user();
            // Crear un nuevo usuario
            $user = User::create([
                'ci' => $request->ci,
                'name' => $request->name,
                'lastname' => $request->lastname,
                'gender' => $request->gender,
                'address' => $request->address,
                'birth_date' => $request->birth_date,
                'image' => $path,
                'nivel' => $request->nivel,
                'email' => $request->email,
                'password' => $password,
            ]);
            $estudiante = Estudiante::create([
                'id' => $user->id,
                'puntuacion' => $request->puntuacion,
                'nivel_id' => $request->nivel,
            ]);
            $vinculado = EstudianteProfesor::create([
                'estudiante_id' => $estudiante->id,
                'profesor_id' => $profesor->id
            ]);
            return redirect()->route('admin.estudiante.index')->with('success', 'Estudiante creado con éxito.');
        } else if ($request->radioOpcion == "2") { //Si el estudiante ya tiene cuenta
            $request->validate([
                'estudiante_id' => 'required|exists:users,id'
            ]);
            $user = Auth::user();
            if ($user->hasRole('profesor')) {
                // Lógica para el rol 'profesor'
                $profesor = $user->profesor;
                $estudiante = Estudiante::find($request->estudiante_id);

                if ($estudiante) {
                    $estudianteProfesor = $estudiante->estudianteProfesors()->where('estado', true)->where('profesor_id', $profesor->id)->first();

                    if (!$estudianteProfesor) {
                        EstudianteProfesor::create([
                            'estudiante_id' => $request->estudiante_id,
                            'profesor_id' => $profesor->id
                        ]);

                        return redirect()->route('admin.estudiante.index')->with('success', 'Estudiante vinculado al profesor con éxito.');
                    } else {
                        return redirect()->route('admin.estudiante.index')->with('error', 'No puede agregar al estudiante porque ya está en su registros.');
                    }
                } else {
                    return redirect()->route('admin.estudiante.index')->with('error', 'Estudiante no encontrado.');
                }
            } else if ($user->hasRole('tutor')) {
                $tutor = $user->tutor;
                $estudiante = Estudiante::find($request->estudiante_id);
                $estudiante->tutor_id = $tutor->id;
                $estudiante->save();
                return redirect()->route('admin.estudiante.index')->with('success', 'Estudiante vinculado al tutor con éxito.');
            } else {
                return redirect()->route('404');
            }
        } else {
            return "Opcion inválida";
        }
    }

    /**
     * Display the specified resource.
     */
    public function deleteTutor(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:users,id'
        ]);

        $estudiante = Estudiante::find($request->estudiante_id);
        $estudiante->tutor_id = null;
        $estudiante->save();
        return redirect()->route('admin.estudiante.tutor', $estudiante->id)->with('success', 'Tutor eliminado exitosamente');
    }

    public function addTutor(Request $request)
    {
        $request->validate([
            'estudiante_modal' => 'required|exists:users,id',
            'tutor_id' => 'required|exists:users,id'
        ]);
        $estudiante = Estudiante::find($request->estudiante_modal);
        $estudiante->tutor_id = $request->tutor_id;
        $estudiante->save();

        return redirect()->route('admin.estudiante.tutor', $estudiante->id)->with('success', 'Tutor asignado exitosamente');
    }
    public function profile(String $id)
    {
        $estudiante = Estudiante::find($id);
        if (isset($estudiante)) {
            $estudiante = Estudiante::with(['puntuacionEjercicios' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])->find($id);
            return view('pages.estudiante.profile', compact('estudiante'));
        } else {
            return "Estudiante no existe";
        }
    }

    public function desvincular(Request $request)
    {
            $request->validate([
                'estudiante_id' => 'required|exists:estudiantes,id',
                'user_id' => 'required|exists:users,id'
            ]);
            $user = User::find($request->user_id);
            
            if ($user->hasRole('profesor')) {
                $estudianteProfesor = EstudianteProfesor::where('estudiante_id', $request->estudiante_id)->where('profesor_id', $request->user_id)->where('estado', true)->first();
                if (isset($estudianteProfesor)) {
                    $estudianteProfesor->estado = false;
                    $estudianteProfesor->save();

                    $gruposProfesor = $estudianteProfesor->profesor->grupos;

                    $grupos = $estudianteProfesor->estudiante->user->grupoUsers->where('habilitado_chat', true)->where('habilitado_grupo', true);

                    if (isset($grupos) && isset($gruposProfesor)) {
                        foreach ($gruposProfesor as $grupoProfesor) {
                            $g = $grupos->where('grupo_id', $grupoProfesor->id)->first();

                            if (isset($g)) {
                                $g->habilitado_chat = false;
                                $g->habilitado_grupo = false;
                                $g->save();
                            }
                        }
                    } else {
                    }
                    return redirect()->route('admin.estudiante.index')->with('success', 'Estudiante desvinculado al profesor exitosamente');
                } else {
                    return redirect()->route('404');
                }
            }
            
            if ($user->hasRole('tutor')) {
                $estudiante = Estudiante::find($request->estudiante_id);
                $estudiante->tutor_id = null;
                $estudiante->save();
                return redirect()->route('admin.estudiante.index')->with('success', 'Estudiante desvinculado al tutor exitosamente');
            }
            return redirect()->route('404');
    }
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
