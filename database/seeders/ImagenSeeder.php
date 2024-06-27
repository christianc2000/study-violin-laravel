<?php

namespace Database\Seeders;

use App\Models\Imagen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImagenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imagenes = [
            //nivel 1
            [
                'nombre' => 'blue',
                'url' => '/foto-grupos/grupo1-blue.png',
                'nivel_id'=>1
            ],
            [
                'nombre' => 'green',
                'url' => '/foto-grupos/grupo1-green.png',
                'nivel_id'=>1
            ],
            [
                'nombre' => 'red',
                'url' => '/foto-grupos/grupo1-red.png',
                'nivel_id'=>1
            ],
            [
                'nombre' => 'bluelight',
                'url' => '/foto-grupos/grupo1-bluelight.png',
                'nivel_id'=>1
            ],
            [
                'nombre' => 'gray',
                'url' => '/foto-grupos/grupo1-gray.png',
                'nivel_id'=>1
            ],
            [
                'nombre' => 'yellow',
                'url' => '/foto-grupos/grupo1-yellow.png',
                'nivel_id'=>1
            ],
            //nivel 2
            [
                'nombre' => 'blue',
                'url' => '/foto-grupos/grupo2-blue.png',
                'nivel_id'=>2
            ],
            [
                'nombre' => 'green',
                'url' => '/foto-grupos/grupo2-green.png',
                'nivel_id'=>2
            ],
            [
                'nombre' => 'red',
                'url' => '/foto-grupos/grupo2-red.png',
                'nivel_id'=>2
            ],
            [
                'nombre' => 'bluelight',
                'url' => '/foto-grupos/grupo2-bluelight.png',
                'nivel_id'=>2
            ],
            [
                'nombre' => 'gray',
                'url' => '/foto-grupos/grupo2-gray.png',
                'nivel_id'=>2
            ],
            [
                'nombre' => 'yellow',
                'url' => '/foto-grupos/grupo2-yellow.png',
                'nivel_id'=>2
            ],
            //nivel 3
            [
                'nombre' => 'blue',
                'url' => '/foto-grupos/grupo3-blue.png',
                'nivel_id'=>3
            ],
            [
                'nombre' => 'green',
                'url' => '/foto-grupos/grupo3-green.png',
                'nivel_id'=>3
            ],
            [
                'nombre' => 'red',
                'url' => '/foto-grupos/grupo3-red.png',
                'nivel_id'=>3
            ],
            [
                'nombre' => 'bluelight',
                'url' => '/foto-grupos/grupo3-bluelight.png',
                'nivel_id'=>3
            ],
            [
                'nombre' => 'gray',
                'url' => '/foto-grupos/grupo3-gray.png',
                'nivel_id'=>3
            ],
            [
                'nombre' => 'yellow',
                'url' => '/foto-grupos/grupo3-yellow.png',
                'nivel_id'=>3
            ]
        ];
        foreach ($imagenes as $imagen) {
            Imagen::create($imagen);
        }
    }
}
