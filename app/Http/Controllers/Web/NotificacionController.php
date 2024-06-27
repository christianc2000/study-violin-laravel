<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Obtén el usuario autenticado
        $notifications = $user->notifications()->paginate(10); // Cambia el 10 por el número que desees por página
        $user->unreadNotifications->markAsRead(); // Marca todas las notificaciones como leídas al acceder a la página
        return view('pages.notificacion.index', compact('notifications'));
    }
}
