<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticaEstudiante extends Model
{
    use HasFactory;
    public $table = "practica_estudiantes";
    protected $fillable = [
        'completado',
        'fecha_completado',
        'practica_id',
        'estudiante_id'
    ];
    
    public function practica()
    {
        return $this->belongsTo(Practica::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}
