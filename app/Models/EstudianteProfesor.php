<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteProfesor extends Model
{
    use HasFactory;
    protected $fillable = [
        'estado',
        'estudiante_id',
        'profesor_id'
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }
}
