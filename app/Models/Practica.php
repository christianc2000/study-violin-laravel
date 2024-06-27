<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practica extends Model
{
    use HasFactory;
    public $table = "practicas";
    protected $fillable = [
        'nombre',
        'puntaje_requerido',
        'leccion_id'
    ];

    public function leccion()
    {
        return $this->belongsTo(Leccion::class);
    }

    public function practicaEstudiantes()
    {
        return $this->hasMany(PracticaEstudiante::class);
    }

    public function ejercicios()
    {
        return $this->hasMany(Ejercicio::class);
    }

    public function prerrequisitosHijos()
    {
        return $this->hasMany(PrerequisitoPractica::class, 'practica_padre_id');
    }

    public function prerrequisitosPadres()
    {
        return $this->hasMany(PrerequisitoPractica::class, 'practica_hijo_id');
    }
}
