<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrerequisitoLeccion extends Model
{
    use HasFactory;
    public $table = "prerequisito_leccions";
    protected $fillable = [
        'leccion_padre_id',
        'leccion_hijo_id'
    ];

    public function leccionPadre()
    {
        return $this->hasMany(Leccion::class, 'leccion_padre_id');
    }

    public function leccionHijo()
    {
        return $this->hasMany(Leccion::class, 'leccion_hijo_id');
    }
}
