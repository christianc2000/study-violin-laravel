<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    public $table = "grupos";
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_creacion',
        'foto',
        'nivel_id',
        'profesor_id'
    ];

    public function grupoUsers()
    {
        return $this->hasMany(GrupoUser::class);
    }

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }
}
