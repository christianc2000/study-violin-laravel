<?php

namespace Database\Seeders;

use App\Models\Leccion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lecciones = [
            [
                'nombre' => 'Postura',
                'puntaje_requerido' => 0,
                'nivel_id' => 1
            ],
            [
                'nombre' => 'Escala',
                'puntaje_requerido' => 1000,
                'nivel_id' => 1
            ],
            [
                'nombre' => 'Música',
                'puntaje_requerido' => 2000,
                'nivel_id' => 1
            ],
        ];
        foreach ($lecciones as $leccion) {
            Leccion::create($leccion);
        }
    }
}
