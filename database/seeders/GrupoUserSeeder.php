<?php

namespace Database\Seeders;

use App\Models\GrupoUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grupoUsers = [
            
            [
                'fecha_registro' => '2024-06-20 11:01',
                'habilitado_chat' => true,
                'habilitado_grupo' => true,
                'user_id' => 2,
                'grupo_id' => 1
            ],
            [
                'fecha_registro' => '2024-06-20 11:14',
                'habilitado_chat' => true,
                'habilitado_grupo' => true,
                'user_id' => 3,
                'grupo_id' => 1
            ],
            [
                'fecha_registro' => '2024-06-20 11:31',
                'habilitado_chat' => true,
                'habilitado_grupo' => true,
                'user_id' => 4,
                'grupo_id' => 1
            ],
            [
                'fecha_registro' => '2024-06-20 11:44',
                'habilitado_chat' => true,
                'habilitado_grupo' => true,
                'user_id' => 5,
                'grupo_id' => 1
            ]
        ];
        foreach ($grupoUsers as $gu) {
            GrupoUser::create($gu);
        }
    }
}
