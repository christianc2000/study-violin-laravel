<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrerequisitoPractica extends Model
{
    use HasFactory;
    public $table = "prerequisito_practicas";
    protected $fillable = [
        'practica_padre_id',
        'practica_hijo_id'
    ];

    public function practicaPadre()
    {
        return $this->hasMany(Leccion::class, 'practica_padre_id');
    }

    public function practicaHijo()
    {
        return $this->hasMany(Leccion::class, 'practica_hijo_id');
    }
}
