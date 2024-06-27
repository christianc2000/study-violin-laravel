<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;
    public $table = "imagens";
    protected $fillable = [
        'nombre',
        'url',
        'nivel_id',
    ];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }
}
