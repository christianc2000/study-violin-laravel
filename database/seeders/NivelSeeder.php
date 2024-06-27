<?php

namespace Database\Seeders;

use App\Models\Nivel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $niveles = [
            [
                'nombre' => "Nivel 1",
                'puntaje_requerido' => 1000,
                
            ],
            [
                'nombre' => "Nivel 2",
                'puntaje_requerido' => 2000
            ],
            [
                'nombre' => "Nivel 3",
                'puntaje_requerido' => 3000
            ]
        ];
        foreach ($niveles as $nivel) {
            Nivel::create($nivel);
        }
    }
}
