<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use HasFactory;
    public $table = "ejercicios";
    protected $fillable = [
        'nombre',
        'puntuacion',
        'practica_id'
    ];

    public function practica()
    {
        return $this->belongsTo(Practica::class);
    }

    public function puntuacionEjercicios()
    {
        return $this->hasMany(PuntuacionEjercicio::class);
    }
}
