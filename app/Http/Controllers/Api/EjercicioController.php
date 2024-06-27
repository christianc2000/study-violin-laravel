<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ejercicio;
use App\Models\Estudiante;
use App\Notifications\NotificacionEjercicio;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EjercicioController extends Controller
{
    use ApiResponseHelpers;

    public function obtenerPuntos(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'estudiante_id' => 'required|exists:estudiantes,id'
        ]);
        
        if ($validator->fails()) {
            return $this->respondFailedValidation($validator->errors());
        }
        $estudiante = Estudiante::find($request->estudiante_id);

        $estudiante->load('estudianteProfesor.profesor.user','user');
        return $this->respondWithSuccess($estudiante);
    }

    public function registrarPuntaje(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ejercicio_id' => 'required|exists:ejercicios,id',
            'fecha_registro' => 'required',
            'user_id' => 'required|exists:users,id', //user del estudiante
            'puntos' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->respondFailedValidation($validator->errors());
        }
        $ejercicio = Ejercicio::find($request->ejercicio_id);
        $estudiante = Estudiante::find($request->user_id);
        $profesoresValidos = $estudiante->estudianteProfesors->where('estado', true);
        $estudiante->puntuacion = (int)$estudiante->puntuacion + (int)$request->puntos;
        $estudiante->save();
        $content = "El estudiante " . $estudiante->user->name . " " . $estudiante->user->lastname . " ha completado el ejercicio '" . $ejercicio->nombre . "' y ha obtenido " . $request->puntos . " puntos.";
        foreach ($profesoresValidos as $profesorvalido) {
            $profesorvalido->profesor->user->notify(new NotificacionEjercicio('Ejercicio realizado', $content, $estudiante->user->image, $ejercicio->id, $estudiante->id));
        }
        if(isset($estudiante->tutor)){
            $estudiante->tutor->user->notify(new NotificacionEjercicio('Ejercicio realizado', $content, $estudiante->user->image, $ejercicio->id, $estudiante->id));
        }

        $puntuacionEjercicio = $ejercicio->puntuacionEjercicios()->create([
            'puntuacion_obtenida' => $request->puntos,
            'fecha_registro' => $request->fecha_registro,
            'estudiante_id' => $estudiante->id
        ]);
        $puntuacionTotal = $estudiante->puntuacionTotalEjercicio($ejercicio->id);
        return $this->respondWithSuccess($estudiante);
    }
}
