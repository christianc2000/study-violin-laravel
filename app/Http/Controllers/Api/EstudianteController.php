<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\Nivel;
use App\Models\Profesor;
use App\Models\User;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstudianteController extends Controller
{
    use ApiResponseHelpers;

    public function searchUser(Request $request)
    {
        $search = $request->get('query');
        $estudiantesQuery = Estudiante::query();

        if (empty($search)) {
            // Obtener una muestra aleatoria de hasta 3 elementos
            $users = $estudiantesQuery->with('user')->inRandomOrder()->take(3)->get();
        } else {
            // Realizar la búsqueda insensible a mayúsculas y minúsculas
            $users = $estudiantesQuery->whereHas('user', function ($query) use ($search) {
                $query->whereRaw('LOWER(email) LIKE ?', ["%" . strtolower($search) . "%"])
                    ->orWhereRaw('LOWER(name) LIKE ?', ["%" . strtolower($search) . "%"])
                    ->orWhereRaw('LOWER(lastname) LIKE ?', ["%" . strtolower($search) . "%"]);
            })->with('user')->get();
        }

        return $this->respondWithSuccess($users);
    }
    public function store(Request $request)
    {
        return "pasa el formulario";
    }
    public function obtenerNivel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:estudiantes,id', //user del estudiante
        ]);

        if ($validator->fails()) {
            return $this->respondFailedValidation($validator->errors());
        }
        $user = User::find($request->user_id);
        $nivel = $user->estudiante->niveles;

        return $this->respondWithSuccess($nivel);
    }
}
