<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Suscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $planes = Plan::all();
        $suscripciones = $user->suscripcions;
        return view('pages.suscripcion.index', compact('planes', 'suscripciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function renovar()
    {
        $planes = Plan::all();
        return view('pages.suscripcion.renovar', compact('planes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'fecha_registro' => 'required|date',
            'fecha_finalizacion' => 'required|date'
        ]);

        $user = Auth::user();
        $plan = Plan::find($request->plan_id);
        Suscripcion::create([
            'estado' => true,
            'cantidad_mes' => $plan->mes,
            'costo_total' => $plan->costo,
            'fecha_registro' => $request->fecha_registro,
            'fecha_finalizacion' => $request->fecha_finalizacion,
            'plan_id' => $plan->id,
            'user_id' => $user->id
        ]);
        return redirect()->route('admin.suscripcion.index')->with('success','Suscripción renovada exitosamente');
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
