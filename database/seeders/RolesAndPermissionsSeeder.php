<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos
        $permissions = [
            'gestionar estudiante',
            'gestionar grupo',
            'gestionar reporte',
            'gestionar notificación',
            'gestionar perfil',
            'gestionar suscripción',
            'visualizar profesor',
            'visualizar estudiante'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crear roles y asignar permisos
        $profesorRole = Role::create(['name' => 'profesor']);
        $profesorRole->givePermissionTo([
            'gestionar estudiante',
            'gestionar grupo',
            'gestionar reporte',
            'gestionar notificación',
            'gestionar perfil'
        ]);

        $tutorRole = Role::create(['name' => 'tutor']);
        $tutorRole->givePermissionTo([
            'gestionar suscripción',
            'gestionar reporte',
            'gestionar notificación',
            'visualizar profesor',
            'gestionar perfil',
            'visualizar estudiante'
        ]);
    }
}
