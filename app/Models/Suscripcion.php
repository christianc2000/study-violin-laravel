<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    use HasFactory;
    public $table = "suscripcions";
    protected $fillable = [
        'estado',
        'cantidad_mes',
        'costo_total',
        'fecha_registro',
        'fecha_finalizacion',
        'plan_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
