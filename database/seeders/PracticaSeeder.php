<?php

namespace Database\Seeders;

use App\Models\Practica;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PracticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $practicas = [
            [
                'nombre' => 'Postura de agarre del violín',
                'puntaje_requerido' => 0,
                'leccion_id'=>1
            ],
            [
                'nombre' => 'Postura de agarre del violín',
                'puntaje_requerido' => 400,
                'leccion_id'=>1
            ],
            [
                'nombre' => 'Postura de agarre del violín',
                'puntaje_requerido' => 800,
                'leccion_id'=>1
            ]
        ];
        foreach ($practicas as $practica) {
            Practica::create($practica);
        }
    }
}

