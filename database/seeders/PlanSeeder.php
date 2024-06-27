<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $planes = [
            [
                'titulo'=>'Plan Mensual',
                'mes'=>1,
                'costo'=>50,
                
            ],
            [
                'titulo'=>'Plan Semestral',
                'mes'=>6,
                'costo'=>240,
            ],
            [
                'titulo'=>'Plan Anual',
                'mes'=>12,
                'costo'=>360,
            ]
        ];
        foreach ($planes as $plan) {
            Plan::create($plan);
        }
    }
}
