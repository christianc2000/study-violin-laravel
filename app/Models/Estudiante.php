<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    public $table = "estudiantes";
    protected $fillable=[
        'id',
        'puntuacion',
        'nivel_id',
        'tutor_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function estudianteProfesors()
    {
        return $this->hasMany(EstudianteProfesor::class);
    }
    
    public function puntuacionEjercicios()
    {
        return $this->hasMany(PuntuacionEjercicio::class);
    }

    public function niveles()
    {
        return $this->belongsTo(Nivel::class, 'nivel_id', 'id');
    }
    public function puntuacionTotalEjercicio(int $ejercicioId)
    {
        // Obtener la suma de puntuaciones del ejercicio específico para este estudiante
        $puntuacionTotal = $this->puntuacionEjercicios()
                               ->where('ejercicio_id', $ejercicioId)
                               ->sum('puntuacion_obtenida');

        return $puntuacionTotal;
    }
}
