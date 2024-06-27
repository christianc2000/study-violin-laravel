<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Profesor;
use App\Models\Suscripcion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'ci' => '9821736',
            'name' => 'Christian Celso',
            'lastname' => 'Mamani Soliz',
            'gender' => 'M',
            'birth_date' => '2000-01-04',
            'address' => 'Santa Cruz',
            'image' => 'https://ddcoey7kqdip9.cloudfront.net/uploads/2020/08/Laravel-big.png',
            'email' => 'christian@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole('profesor');
        $profesor = new Profesor([
            'biografia' => 'Tengo 20 años de experiencia como profesor de violín',
            'estudios' => 'UAGRM'
        ]);


        $user->profesor()->save($profesor);
        $plan = Plan::find(3);
        $fechaRegistro = Carbon::now();
        $fechaFinalizacion = $fechaRegistro->addMonths($plan->mes);
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
