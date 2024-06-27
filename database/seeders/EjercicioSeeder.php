<?php

namespace Database\Seeders;

use App\Models\Ejercicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EjercicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ejercicios = [
            [
                'nombre' => 'Espalda recta',
                'puntuacion' => 50,
                'practica_id'=>1
            ],
            [
                'nombre' => 'Piernas abiertas',
                'puntuacion' => 50,
                'practica_id'=>1
            ],
            [
                'nombre' => 'Pies al exterior',
                'puntuacion' => 50,
                'practica_id'=>1
            ],
            [
                'nombre' => 'Balanceo cadera izquierda',
                'puntuacion' => 50,
                'practica_id'=>1
            ],
            [
                'nombre' => 'Balanceo cadera derecha',
                'puntuacion' => 50,
                'practica_id'=>1
            ],
            [
                'nombre' => 'Postura recta',
                'puntuacion' => 50,
                'practica_id'=>1
            ],
            [
                'nombre' => 'Levantar brazo izquierdo',
                'puntuacion' => 50,
                'practica_id'=>1
            ],
            [
                'nombre' => 'Bajar brazo izquierdo',
                'puntuacion' => 50,
                'practica_id'=>1
            ],
            [
                'nombre' => 'Levantar violin',
                'puntuacion' => 50,
                'practica_id'=>1
            ],
            [
                'nombre' => 'Postura_violin',
                'puntuacion' => 50,
                'practica_id'=>1
            ]
        ];
        foreach ($ejercicios as $ejercicio) {
            Ejercicio::create($ejercicio);
        }
    }
}
