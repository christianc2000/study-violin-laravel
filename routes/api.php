<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EjercicioController;
use App\Http\Controllers\Api\EstudianteController;
use App\Http\Controllers\Api\GrupoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->group(function () {
    Route::get('perfil', [AuthController::class, 'perfil'])->name('api.perfil');
    Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');
});
Route::post('login', [AuthController::class, 'login'])->name('api.login');
Route::get('grupos/{id}', [GrupoController::class, 'getGruposByNivel']);
Route::post('grupo/{id}/mensaje', [GrupoController::class, 'sendMessage'])->name('api.send-message');
// buscador de usuario por el username
Route::get('search', [GrupoController::class, 'searchUser']);
Route::get('search-estudiante', [EstudianteController::class, 'searchUser']);
Route::post('registrar-puntos', [EjercicioController::class, 'registrarPuntaje']);
Route::get('obtener-puntos', [EjercicioController::class, 'obtenerPuntos']);
Route::get('obtener-nivel', [EstudianteController::class, 'obtenerNivel']);
