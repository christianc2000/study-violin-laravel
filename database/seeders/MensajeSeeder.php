<?php

namespace Database\Seeders;

use App\Models\Grupo;
use App\Models\Mensaje;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MensajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $grupos = Grupo::all();
        foreach ($grupos as $grupo) {
            if (count($grupo->grupoUsers) > 0) {
                $userIds = $grupo->grupoUsers->pluck('user_id');

                // Añadir el ID del usuario autenticado
                $userIds->push($grupo->profesor->id);

                for ($i = 0; $i < 15; $i++) {
                    Mensaje::create([
                        'txt' => $faker->sentence,
                        'grupo_id' => $grupo->id,
                        'user_id' => $faker->randomElement($userIds),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
