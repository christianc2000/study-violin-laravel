<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;
    public $table = "leccions";
    protected $fillable = [
        'nombre',
        'puntaje_requerido',
        'nivel_id'
    ];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }

    public function prerrequisitosHijos()
    {
        return $this->hasMany(PrerequisitoLeccion::class, 'leccion_padre_id');
    }

    public function prerrequisitosPadres()
    {
        return $this->hasMany(PrerequisitoLeccion::class, 'leccion_hijo_id');
    }

    public function practicas()
    {
        return $this->hasMany(Practica::class);
    }
}
