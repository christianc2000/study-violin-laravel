<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;
    public $table = "nivels";
    protected $fillable = [
        'nombre',
        'puntaje_requerido'
    ];

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }

    public function lecciones()
    {
        return $this->hasMany(Leccion::class);
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }
}
