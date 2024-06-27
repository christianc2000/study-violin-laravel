<?php

namespace Database\Seeders;

use App\Models\Grupo;
use App\Models\Nivel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Recuperar niveles con sus imágenes
        $nivel1 = Nivel::with('imagenes')->find(1);
        $nivel2 = Nivel::with('imagenes')->find(2);
        $nivel3 = Nivel::with('imagenes')->find(3);

        // Verificar que los niveles existen y tienen imágenes antes de continuar
        if (!$nivel1 || !$nivel1->imagenes->isNotEmpty()) {
            $nivel1Image = null;
        } else {
            $nivel1Image = $nivel1->imagenes->random()->url;
        }

        if (!$nivel2 || !$nivel2->imagenes->isNotEmpty()) {
            $nivel2Image = null;
        } else {
            $nivel2Image = $nivel2->imagenes->random()->url;
        }

        if (!$nivel3 || !$nivel3->imagenes->isNotEmpty()) {
            $nivel3Image = null;
        } else {
            $nivel3Image = $nivel3->imagenes->random()->url;
        }

        // Definir los grupos con las imágenes aleatorias
        $grupos = [
            [
                'nombre' => 'Grupo AA - 1-2023',
                'descripcion' => 'Descripción del Grupo 1',
                'foto' => $nivel1Image,
                'fecha_creacion' => '2023-01-01 08:00',
                'fecha_finalizacion' => null,
                'nivel_id' => 1,
                'profesor_id' => 1,
            ],
            [
                'nombre' => 'Grupo A - 2-2023',
                'descripcion' => 'Descripción del Grupo 1',
                'foto' => $nivel1Image,
                'fecha_creacion' => '2023-01-01 08:00',
                'fecha_finalizacion' => null,
                'nivel_id' => 1,
                'profesor_id' => 1,
            ],
            [
                'nombre' => 'Grupo E - 1-2023',
                'descripcion' => 'Descripción del Grupo 1',
                'foto' => $nivel1Image,
                'fecha_creacion' => '2023-01-01 08:00',
                'fecha_finalizacion' => null,
                'nivel_id' => 1,
                'profesor_id' => 1,
            ],
            [
                'nombre' => 'Grupo B - 2-2023',
                'descripcion' => 'Descripción del Grupo 1',
                'foto' => $nivel1Image,
                'fecha_creacion' => '2023-01-01 08:00',
                'fecha_finalizacion' => null,
                'nivel_id' => 1,
                'profesor_id' => 1,
            ],
            [
                'nombre' => 'Grupo D - 1-2023',
                'descripcion' => 'Descripción del Grupo 2',
                'foto' => $nivel2Image,
                'fecha_creacion' => '2023-01-01 08:00',
                'fecha_finalizacion' => null,
                'nivel_id' => 2,
                'profesor_id' => 1,
            ],
            [
                'nombre' => 'Grupo E - 2-2023',
                'descripcion' => 'Descripción del Grupo 3',
                'foto' => $nivel3Image,
                'fecha_creacion' => '2023-01-01 08:00',
                'fecha_finalizacion' => null,
                'nivel_id' => 3,
                'profesor_id' => 1,
            ],
        ];

        // Iterar sobre el array y crear los registros en la base de datos
        foreach ($grupos as $grupo) {
            Grupo::create($grupo);
        }
    }
}
