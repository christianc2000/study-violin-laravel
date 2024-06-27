<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Suscripcion;
use App\Models\Tutor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;

class TutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $client = new Client([
            'base_uri' => 'https://picsum.photos',
            'timeout'  => 10.0,
        ]);
        foreach (range(1, 3) as $index) {
            // Generar nombre de archivo único para la imagen
            $filename = $faker->unique()->word . '.jpg'; // Puedes cambiar la extensión si prefieres

            // Obtener una imagen aleatoria de Lorem Picsum
            $response = $client->get('/640/480', ['stream' => true]);

            // Guardar la imagen en la carpeta pública (public/images)
            $publicPath = public_path('imagenes/' . $filename);
            File::put($publicPath, $response->getBody()->getContents());
            $imagePath = '/' . 'imagenes/' . $filename;

            $user = User::create([
                'ci' => "" . $faker->numberBetween(10000000, 90000000),
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'gender' => $faker->randomElement(['M', 'F']),
                'birth_date' => $faker->date,
                'address' => $faker->address,
                'image' => $imagePath, // Ruta relativa al archivo de imagen
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('12345678'), // Contraseña predeterminada
            ]);
            $user->assignRole('tutor');
            Tutor::create([
                'id' => $user->id,
                'ocupacion' => $faker->firstName
            ]);
            $plan = Plan::find($faker->numberBetween(1, 3));
            $fechaRegistro = $faker->dateTimeBetween('-1 year', 'now');
            $fechaFinalizacion = Carbon::parse($fechaRegistro)->addMonths($plan->mes);
            Suscripcion::create([
                'estado' => true,
                'cantidad_mes' => $plan->mes,
                'costo_total' => $plan->costo,
                'fecha_registro' => $fechaRegistro,
                'fecha_finalizacion' => $fechaFinalizacion,
                'plan_id' => $plan->id,
                'user_id' => $user->id
            ]);
        }
        $filename = $faker->unique()->word . '.jpg'; // Puedes cambiar la extensión si prefieres

        // Obtener una imagen aleatoria de Lorem Picsum
        $response = $client->get('/640/480', ['stream' => true]);

        // Guardar la imagen en la carpeta pública (public/images)
        $publicPath = public_path('imagenes/' . $filename);
        File::put($publicPath, $response->getBody()->getContents());
        $imagePath = '/' . 'imagenes/' . $filename;
        $user = User::create([
            'ci' => "7319239",
            'name' => "Nadia",
            'lastname' => "Torrico",
            'gender' => "F",
            'birth_date' => "2002-05-27",
            'address' => "Villa 1ro de Mayo",
            'image' => $imagePath, // Ruta relativa al archivo de imagen
            'email' => "nadia@gmail.com",
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole('tutor');
        Tutor::create([
            'id' => $user->id,
            'ocupacion' => $faker->firstName
        ]);
        $plan = Plan::find($faker->numberBetween(1, 3));
        $fechaRegistro = Carbon::now();
        $fechaFinalizacion = Carbon::parse($fechaRegistro)->addMonths($plan->mes);
        Suscripcion::create([
            'estado' => true,
            'cantidad_mes' => $plan->mes,
            'costo_total' => $plan->costo,
            'fecha_registro' => Carbon::now(),
            'fecha_finalizacion' => $fechaFinalizacion,
            'plan_id' => $plan->id,
            'user_id' => $user->id
        ]);
    }
}
