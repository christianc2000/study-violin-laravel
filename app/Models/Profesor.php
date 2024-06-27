<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;
    public $table = "profesors";
    protected $fillable = [
        'id',
        'biografia',
        'estudio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public function estudianteProfesors()
    {
        return $this->hasMany(EstudianteProfesor::class);
    }
}
