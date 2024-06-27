<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;
    public $table = "tutors";
    protected $fillable = [
        'id',
        'ocupacion'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }
}
