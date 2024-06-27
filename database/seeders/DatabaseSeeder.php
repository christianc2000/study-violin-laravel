<?php

namespace Database\Seeders;

use App\Models\Ejercicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            DashboardTableSeeder::class,
            RolesAndPermissionsSeeder::class,
            PlanSeeder::class,
            UserSeeder::class,
            NivelSeeder::class,
            ImagenSeeder::class,
            GrupoSeeder::class,
            TutorSeeder::class,
            EstudianteSeeder::class,
            GrupoUserSeeder::class,
            MensajeSeeder::class,
            LeccionSeeder::class,
            PracticaSeeder::class,
            EjercicioSeeder::class,
            // AnalyticsTableSeeder::class,
            // FintechTableSeeder::class,
            // CustomerSeeder::class,
            // OrderSeeder::class,
            // InvoiceSeeder::class,
            // MemberSeeder::class,
            // TransactionSeeder::class,
            // JobSeeder::class,
            // CampaignSeeder::class,
            // MarketerSeeder::class,
            // CampaignMarketerSeeder::class,
        ]);
    }
}
